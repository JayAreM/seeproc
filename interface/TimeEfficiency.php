<?php

require_once('../includes/database.php');


$dropdown1 = isset($_GET['dropdown1']) ? $_GET['dropdown1'] : 'Preparation';
$status = isset($_GET['status']) ? $_GET['status'] : 'All';
$gOffice = isset($_GET['goffice']) ? $_GET['goffice'] : 'All';

$sql = "";

switch ($dropdown1) {

    case 'Preparation':
        if ($status == 'Check Released') {
            $receivedStatus = 'For Inspection';
            $TrackingType = "and TrackingType = 'PR'";
        } else {
            $receivedStatus = ($status == 'For P.O') ? 'CBO Received' : 'GSO Received';
        }

        if($gOffice == 'All'){
            $gOffice = '1 or b.OfficeType = 2';
        }
        
        
        $substringFunction = ($status == 'For P.O') ? "SUBSTRING(TrackingNumber, 4, 4)" : "SUBSTRING(TrackingNumber, 1, 4)";
    
        if ($status == 'All') {
            $sql = "
            SELECT b.Name, ROUND(AVG(a.Ave), 3) AS Ave
            FROM (
                SELECT SUBSTRING(TrackingNumber, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
                FROM (
                    SELECT a.TrackingNumber, 
                        DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                    FROM (
                        SELECT DISTINCT TrackingNumber
                        FROM vouchercurrent
                        WHERE status = 'For P.O'
                    ) a
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D1
                        FROM voucherhistory
                        WHERE status = 'Encoded' AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) b ON a.TrackingNumber = b.TrackingNumber
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D2
                        FROM voucherhistory
                        WHERE status = 'CBO Received'
                        AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) c ON a.TrackingNumber = c.TrackingNumber
                ) subquery
                GROUP BY SUBSTRING(TrackingNumber, 4, 4)

                UNION ALL

                 SELECT SUBSTRING(TrackingNumber, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
                FROM (
                    SELECT a.TrackingNumber, 
                        DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                    FROM (
                        SELECT DISTINCT TrackingNumber
                        FROM vouchercurrent
                        WHERE status = 'Waiting for Delivery'
                    ) a
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D1
                        FROM voucherhistory
                        WHERE status = 'Encoded' AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) b ON a.TrackingNumber = b.TrackingNumber
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D2
                        FROM voucherhistory
                        WHERE status = 'GSO Received'
                        AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) c ON a.TrackingNumber = c.TrackingNumber
                ) subquery
                GROUP BY SUBSTRING(TrackingNumber, 1, 4)

                UNION ALL

                SELECT SUBSTRING(TrackingNumber, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
                FROM (
                    SELECT a.TrackingNumber, 
                        DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                    FROM (
                        SELECT DISTINCT TrackingNumber
                        FROM vouchercurrent
                        WHERE status = 'Check Released'
                    ) a
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D1
                        FROM voucherhistory
                        WHERE status = 'Encoded' AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) b ON a.TrackingNumber = b.TrackingNumber
                    INNER JOIN (
                        SELECT TrackingNumber, MIN(DateModified) AS D2
                        FROM voucherhistory
                        WHERE status = 'For Inspection'
                        AND TrackingNumber != ''
                        GROUP BY TrackingNumber
                    ) c ON a.TrackingNumber = c.TrackingNumber
                ) subquery
                GROUP BY SUBSTRING(TrackingNumber, 1, 4)
            ) a
            LEFT JOIN office b ON a.Office = b.Code
            WHERE b.OfficeType = $gOffice
            GROUP BY b.Name
            ORDER BY Ave ASC;
            ";
        } else {
            $sql = "
            SELECT b.Name, ROUND(AVG(Days), 2) AS Ave
            FROM (
                SELECT a.TrackingNumber, 
                    DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                FROM (
                    SELECT DISTINCT TrackingNumber
                    FROM vouchercurrent
                    WHERE status = '$status'
                ) a
                INNER JOIN (
                    SELECT TrackingNumber, MIN(DateModified) AS D1
                    FROM voucherhistory
                    WHERE status = 'Encoded' AND TrackingNumber != ''
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                INNER JOIN (
                    SELECT TrackingNumber, MIN(DateModified) AS D2
                    FROM voucherhistory
                    WHERE status = '$receivedStatus'
                    AND TrackingNumber != ''
                    GROUP BY TrackingNumber
                ) c ON a.TrackingNumber = c.TrackingNumber
            ) a
            LEFT JOIN office b ON $substringFunction = b.Code
           WHERE b.OfficeType = $gOffice
            GROUP BY b.Name
            ORDER BY Ave ASC;
            ";

            echo $sql;
        }
    break;
    
    case 'Option 2':
        if ($status == 'Check Released') {
            $case1 = 'CTO';
            $case2 = 'GSO';
            $case3 = 'CBO';
            $case4 = 'CAO';
            $case5 = 'Admin';
            $TrackingType = "and TrackingType = 'PX'";

        }else if($status == 'Waiting for Delivery'){
            $case1 = 'CTO';
            $case2 = 'GSO';
            $case3 = 'CBO';
            $case4 = 'CAO';
            $case5 = 'Admin';
            $TrackingType = '';
        }
         else if ($status == 'For P.O') {
            $case1 = 'CTO';
            $case2 = 'GSO';
            $case3 = 'CBO';
            $case4 = 'BAC';
            $case5 = 'Admin';
            $TrackingType = "and TrackingType = 'PR'";
        } 
        $substringFunction = ($status == 'For P.O') ? "SUBSTRING(a.TrackingNumber, 4, 4)" : "SUBSTRING(a.TrackingNumber, 1, 4)";

        if($gOffice == 'All'){
            $gOffice = '1 or b.OfficeType = 2';
        }
       
        if ($status == 'All') {
          $sql ="
            WITH check_released AS (
    SELECT 
        b.Name AS Name,
        ROUND(AVG(a.Days), 2) AS Ave,
        'Check Released' AS Status
    FROM (
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Check Released'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CTO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Check Released'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - GSO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Check Released'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CBO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Check Released'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CAO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CAO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CAO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Check Released'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - Admin' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'Admin Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory	
                WHERE Status = 'Admin Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
   WHERE b.OfficeType = $gOffice
    GROUP BY b.Name
    order by Ave asc
),

wait AS (
    SELECT 
        b.Name AS Name,
        ROUND(AVG(a.Days), 2) AS Ave,
         'Waiting for Delivery' AS Status
    FROM (
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Waiting for Delivery'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CTO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Waiting for Delivery'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - GSO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Waiting for Delivery'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CBO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Waiting for Delivery'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - BAC' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'BAC Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'BAC Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 1, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'Waiting for Delivery'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - Admin' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'Admin Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory	
                WHERE Status = 'Admin Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
    WHERE b.OfficeType = $gOffice
    GROUP BY b.Name
    order by Ave asc
),

for_po AS (
    SELECT 
        b.Name AS Name,
        ROUND(AVG(a.Days), 2) AS Ave,
         'For P.O' AS Status
    FROM (
        SELECT 
            SUBSTRING(a.TrackingNumber, 4, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'For P.O'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CTO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CTO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 4, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'For P.O'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - GSO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'GSO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 4, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'For P.O'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CBO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CBO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 4, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'For P.O'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - CAO' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CAO Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory
                WHERE Status = 'CAO Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber

        UNION
        
        SELECT 
            SUBSTRING(a.TrackingNumber, 4, 4) AS Office, 
            DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
        FROM (
            SELECT DISTINCT TrackingNumber
            FROM citydoc2024.vouchercurrent
            WHERE status = 'For P.O'
        ) a
        INNER JOIN (
            SELECT 
                TrackingNumber, 
                Status AS Status1, 
                DateModified AS D1
            FROM citydoc2024.voucherhistory
            WHERE status = 'Pending Released - Admin' 
              AND TrackingNumber != ''
            GROUP BY TrackingNumber
            ORDER BY TrackingNumber
        ) b ON a.TrackingNumber = b.TrackingNumber
        LEFT JOIN (
            SELECT 
                a.TrackingNumber, 
                b.Status, 
                D2
            FROM (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    DateModified AS D2
                FROM citydoc2024.voucherhistory
                WHERE Status = 'Admin Received'
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status, 
                    MIN(DateModified) AS D2x
                FROM citydoc2024.voucherhistory	
                WHERE Status = 'Admin Received'
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            WHERE a.D2 != b.D2x 
              AND a.TrackingNumber != ''
            GROUP BY a.TrackingNumber
        ) c ON a.TrackingNumber = c.TrackingNumber
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
    WHERE b.OfficeType = $gOffice
    GROUP BY b.Name
    order by Ave asc
),
combined AS (
    SELECT Name, Ave, Status
    FROM check_released
    UNION ALL
    SELECT Name, Ave, Status
    FROM wait
    UNION ALL
    SELECT Name, Ave, Status
    FROM for_po
)
SELECT 
    Name,
    ROUND(AVG(Ave), 3) AS Ave
FROM combined
GROUP BY Name
ORDER BY Ave ASC;
            ";
        }  
        
        else {
            $sql ="
            SELECT 
            b.Name AS Name,
            ROUND(AVG(a.Days), 2) AS Ave
        FROM (
            SELECT 
                $substringFunction AS Office, 
                DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = '$status'
                 $TrackingType
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status AS Status1, 
                    DateModified AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - " . $case1 . "' 
                  AND TrackingNumber != ''
                GROUP BY TrackingNumber
                ORDER BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            LEFT JOIN (
                SELECT 
                    a.TrackingNumber, 
                    b.Status, 
                    D2
                FROM (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        DateModified AS D2
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case1 . " Received'
                ) a
                INNER JOIN (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        MIN(DateModified) AS D2x
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case1 . " Received'
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                WHERE a.D2 != b.D2x 
                  AND a.TrackingNumber != ''
                GROUP BY a.TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
            
            union
            
            
            SELECT 
                $substringFunction AS Office, 
                DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = '$status'
                 $TrackingType
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status AS Status1, 
                    DateModified AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - " . $case2 . "' 
                  AND TrackingNumber != ''
                GROUP BY TrackingNumber
                ORDER BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            LEFT JOIN (
                SELECT 
                    a.TrackingNumber, 
                    b.Status, 
                    D2
                FROM (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        DateModified AS D2
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case2 . " Received'
                ) a
                INNER JOIN (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        MIN(DateModified) AS D2x
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case2 . " Received'
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                WHERE a.D2 != b.D2x 
                  AND a.TrackingNumber != ''
                GROUP BY a.TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
            
            UNION
            
            SELECT 
                $substringFunction AS Office, 
                DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = '$status'
                 $TrackingType
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status AS Status1, 
                    DateModified AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - " . $case3 . "' 
                  AND TrackingNumber != ''
                GROUP BY TrackingNumber
                ORDER BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            LEFT JOIN (
                SELECT 
                    a.TrackingNumber, 
                    b.Status, 
                    D2
                FROM (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        DateModified AS D2
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case3 . " Received'
                ) a
                INNER JOIN (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        MIN(DateModified) AS D2x
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case3 . " Received'
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                WHERE a.D2 != b.D2x 
                  AND a.TrackingNumber != ''
                GROUP BY a.TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
            
            UNION
            
            SELECT 
                $substringFunction AS Office, 
                DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = '$status'
                 $TrackingType
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status AS Status1, 
                    DateModified AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - " . $case4 . "' 
                  AND TrackingNumber != ''
                GROUP BY TrackingNumber
                ORDER BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            LEFT JOIN (
                SELECT 
                    a.TrackingNumber, 
                    b.Status, 
                    D2
                FROM (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        DateModified AS D2
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case4 . " Received'
                ) a
                INNER JOIN (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        MIN(DateModified) AS D2x
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case4 . " Received'
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                WHERE a.D2 != b.D2x 
                  AND a.TrackingNumber != ''
                GROUP BY a.TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
            
            UNION
            
            SELECT 
                $substringFunction AS Office, 
                DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = '$status'
                 $TrackingType
            ) a
            INNER JOIN (
                SELECT 
                    TrackingNumber, 
                    Status AS Status1, 
                    DateModified AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - " . $case5 . "' 
                  AND TrackingNumber != ''
                GROUP BY TrackingNumber
                ORDER BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            LEFT JOIN (
                SELECT 
                    a.TrackingNumber, 
                    b.Status, 
                    D2
                FROM (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        DateModified AS D2
                    FROM citydoc2024.voucherhistory
                    WHERE Status = '" . $case5 . " Received'
                ) a
                INNER JOIN (
                    SELECT 
                        TrackingNumber, 
                        Status, 
                        MIN(DateModified) AS D2x
                    FROM citydoc2024.voucherhistory	
                    WHERE Status = '" . $case5 . " Received'
                    GROUP BY TrackingNumber
                ) b ON a.TrackingNumber = b.TrackingNumber
                WHERE a.D2 != b.D2x 
                  AND a.TrackingNumber != ''
                GROUP BY a.TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
            
        ) a 
        LEFT JOIN citydoc2024.office b ON a.Office = b.Code
        WHERE b.OfficeType = $gOffice
        GROUP BY b.Name
        ORDER BY Ave ASC;
        
            ";
            echo $sql;
        }

    break;

    case 'Option 3':
            // Option 3 SQL query, because options 1 and 2 just aren't enough
            if ($status == 'Check Released') {
                $case1 = 'CTO';
                $case2 = 'GSO';
                $case3 = 'CBO';
                $case4 = 'CAO';
                $case5 = 'Admin';
                $TrackingType = "and TrackingType = 'PX'";
    
            }else if($status == 'Waiting for Delivery'){
                $case1 = 'CTO';
                $case2 = 'GSO';
                $case3 = 'CBO';
                $case4 = 'CAO';
                $case5 = 'Admin';
                $TrackingType = '';
            }
             else if ($status == 'For P.O') {
                $case1 = 'CTO';
                $case2 = 'GSO';
                $case3 = 'CBO';
                $case4 = 'BAC';
                $case5 = 'Admin';
                $TrackingType = "and TrackingType = 'PR'";
            } 

            if($gOffice == 'All'){
                $gOffice = '1 or b.OfficeType = 2';
            }

            $substringFunction = $status == 'For P.O' ? "SUBSTRING(MainTN, 4, 4)" : "SUBSTRING(MainTN, 1, 4)";
            
            if($status == 'All'){


                $sql = " 
                WITH check_released AS (
    SELECT b.Name AS OfficeName, a.Ave as Average
    FROM (
        -- Query for Pending at CTO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Check Released'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at GSO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Check Released'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at CBO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Check Released'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at CAO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Check Released'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CAO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CAO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at Admin
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Check Released'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
    WHERE b.OfficeType = $gOffice
),

wait_for AS (
    SELECT b.Name AS OfficeName, a.Ave as Average
    FROM (
        -- Query for Pending at CTO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Waiting for Delivery'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at GSO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Waiting for Delivery'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at CBO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Waiting for Delivery'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at CAO
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Waiting for Delivery'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CAO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CAO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
        
        UNION ALL
        
        -- Query for Pending at Admin
        SELECT SUBSTRING(MainTN, 1, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'Waiting for Delivery'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 1, 4)
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
    WHERE b.OfficeType = $gOffice
),


for_po AS (
    SELECT b.Name AS OfficeName, a.Ave as Average
    FROM (
        -- Query for Pending at CTO
        SELECT SUBSTRING(MainTN, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'For P.O'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CTO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 4, 4)
        
        UNION ALL
        
        -- Query for Pending at GSO
        SELECT SUBSTRING(MainTN, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'For P.O'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - GSO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 4, 4)
        
        UNION ALL
        
        -- Query for Pending at CBO
        SELECT SUBSTRING(MainTN, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'For P.O'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CBO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 4, 4)
        
        UNION ALL
        
        -- Query for Pending at BAC
        SELECT SUBSTRING(MainTN, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'For P.O'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at BAC' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - CAO' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 4, 4)
        
        UNION ALL
        
        -- Query for Pending at Admin
        SELECT SUBSTRING(MainTN, 4, 4) AS Office, ROUND(AVG(Days), 2) AS Ave
        FROM (
            SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2, 
                   DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
            FROM (
                SELECT DISTINCT TrackingNumber
                FROM citydoc2024.vouchercurrent
                WHERE status = 'For P.O'
            ) a
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending at Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) b ON a.TrackingNumber = b.TrackingNumber
            INNER JOIN (
                SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                FROM citydoc2024.voucherhistory
                WHERE status = 'Pending Released - Admin' AND TrackingNumber != ''
                GROUP BY TrackingNumber
            ) c ON a.TrackingNumber = c.TrackingNumber
        ) a
        GROUP BY SUBSTRING(MainTN, 4, 4)
    ) a
    LEFT JOIN citydoc2024.office b ON a.Office = b.Code
   WHERE b.OfficeType = $gOffice
)


-- Final aggregation and ordering

SELECT OfficeName as Name, 
       ROUND(AVG(AverageDays), 3) AS Ave
FROM (
    SELECT OfficeName, AVG(Average) AS AverageDays
    FROM check_released
    GROUP BY OfficeName

    UNION ALL

    SELECT OfficeName, AVG(Average) AS AverageDays
    FROM wait_for
    GROUP BY OfficeName

    UNION ALL

    SELECT OfficeName, AVG(Average) AS AverageDays
    FROM for_po
    GROUP BY OfficeName
) AS Combined
GROUP BY OfficeName
Order by Ave ASC

 ";

            }
            else{
            $sql = "
            SELECT *, AVG(Ave) AS Ave
            FROM (
                (SELECT b.Name, a.Ave
                FROM (
                    SELECT  $substringFunction AS Office, ROUND(AVG(Days), 2) AS Ave
                    FROM (
                        SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2,
                               DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                        FROM (
                            SELECT DISTINCT TrackingNumber
                            FROM citydoc2024.vouchercurrent
                            WHERE status = '$status'
                            $TrackingType
                        ) a
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending at ". $case1. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) b ON a.TrackingNumber = b.TrackingNumber
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending Released - ". $case1. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) c ON a.TrackingNumber = c.TrackingNumber
                    ) a
                    GROUP BY  $substringFunction
                ) a
                LEFT JOIN citydoc2024.office b ON a.Office = b.Code
                WHERE b.OfficeType = $gOffice
                ORDER BY Ave ASC)
        
                UNION ALL
        
                (SELECT b.Name, a.Ave
                FROM (
                    SELECT  $substringFunction AS Office, ROUND(AVG(Days), 2) AS Ave
                    FROM (
                        SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2,
                               DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                        FROM (
                            SELECT DISTINCT TrackingNumber
                            FROM citydoc2024.vouchercurrent
                            WHERE status = '$status'
                             $TrackingType
                        ) a
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending at ". $case2. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) b ON a.TrackingNumber = b.TrackingNumber
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending Released - ". $case2. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) c ON a.TrackingNumber = c.TrackingNumber
                    ) a
                    GROUP BY  $substringFunction
                ) a
                LEFT JOIN citydoc2024.office b ON a.Office = b.Code
                WHERE b.OfficeType = $gOffice
                ORDER BY Ave ASC)

                UNION ALL

                 (SELECT b.Name, a.Ave
                FROM (
                    SELECT  $substringFunction AS Office, ROUND(AVG(Days), 2) AS Ave
                    FROM (
                        SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2,
                               DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                        FROM (
                            SELECT DISTINCT TrackingNumber
                            FROM citydoc2024.vouchercurrent
                            WHERE status = '$status'
                             $TrackingType
                        ) a
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending at ". $case3. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) b ON a.TrackingNumber = b.TrackingNumber
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending Released - ". $case3. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) c ON a.TrackingNumber = c.TrackingNumber
                    ) a
                    GROUP BY  $substringFunction
                ) a
                LEFT JOIN citydoc2024.office b ON a.Office = b.Code
               WHERE b.OfficeType = $gOffice
                ORDER BY Ave ASC)

                UNION ALL

                 (SELECT b.Name, a.Ave
                FROM (
                    SELECT  $substringFunction AS Office, ROUND(AVG(Days), 2) AS Ave
                    FROM (
                        SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2,
                               DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                        FROM (
                            SELECT DISTINCT TrackingNumber
                            FROM citydoc2024.vouchercurrent
                            WHERE status = '$status'
                             $TrackingType
                        ) a
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending at ". $case4. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) b ON a.TrackingNumber = b.TrackingNumber
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending Released - ". $case4. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) c ON a.TrackingNumber = c.TrackingNumber
                    ) a
                    GROUP BY  $substringFunction
                ) a
                LEFT JOIN citydoc2024.office b ON a.Office = b.Code
                WHERE b.OfficeType = $gOffice
                ORDER BY Ave ASC)

                UNION ALL

                 (SELECT b.Name, a.Ave
                FROM (
                    SELECT  $substringFunction AS Office, ROUND(AVG(Days), 2) AS Ave
                    FROM (
                        SELECT a.TrackingNumber AS MainTN, b.Status AS Status1, b.D1, c.Status AS Status2, c.D2,
                               DATEDIFF(SUBSTRING(c.D2, 1, 10), SUBSTRING(b.D1, 1, 10)) AS Days
                        FROM (
                            SELECT DISTINCT TrackingNumber
                            FROM citydoc2024.vouchercurrent
                            WHERE status = '$status'
                             $TrackingType
                        ) a
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D1
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending at ". $case5. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) b ON a.TrackingNumber = b.TrackingNumber
                        INNER JOIN (
                            SELECT TrackingNumber, Status, MIN(DateModified) AS D2
                            FROM citydoc2024.voucherhistory
                            WHERE status = 'Pending Released - ". $case5. "' AND TrackingNumber != ''
                            GROUP BY TrackingNumber
                        ) c ON a.TrackingNumber = c.TrackingNumber
                    ) a
                    GROUP BY  $substringFunction
                ) a
                LEFT JOIN citydoc2024.office b ON a.Office = b.Code
                WHERE b.OfficeType = $gOffice
                ORDER BY Ave ASC)

            ) subquery
            GROUP BY Name
            ORDER BY AVE ASC;
        ";
       
            }
          
    break;
        
}

// Execute the query
$record = $database->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Time Efficiency Report</title>
<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-size: 28px;
        font-weight: 300;
    }
    form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    form label {
        font-weight: bold;
        color: #333;
        font-size: 14px;
        margin-top: 10px;
    }
    form select, form input[type="submit"] {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #333;
        border-radius: 6px;
        color: #333;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
    }
    form select:hover, form input[type="submit"]:hover {
        background-color: #e8e8e8;
        cursor: pointer;
    }
    form input[type="submit"] {
        background-color: #2d6830;
        color: white;
        cursor: pointer;
        border: none;
    }
    form input[type="submit"]:hover {
        background-color: #45a049;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table th, table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s;
    }
    table th {
        background-color: #2d6830;
        color: white;
        font-weight: 600;
    }
    table td {
        color: #333;
    }
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    table tr:hover {
        background-color: #ddd;
    }
    .loading-overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        display: none; /* Hidden by default */
    }     
    .loading-overlay img {
        width: 150px; /* Adjust the width as needed */
        height: 150px; /* Adjust the height as needed */
    }
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
        form {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
</head>
<body>

<div class="container">
<div class="loading-overlay" id="loading-overlay">
    <img src="../images/ajaxloader.gif" alt="Loading...">
</div>
    <h1><strong>Average Processing Time Report</strong></h1>

    <form action="" method="get">
        <div style="padding:2px">
            <label for="dropdown1">Type:</label>
            <select name="dropdown1" id="dropdown1">
                <option value="Preparation" <?php echo ($dropdown1 == 'Preparation') ? 'selected' : ''; ?>>Preparation</option>
                <option value="Option 2" <?php echo ($dropdown1 == 'Option 2') ? 'selected' : ''; ?>>Pending Retrieval</option>
                <option value="Option 3" <?php echo ($dropdown1 == 'Option 3') ? 'selected' : ''; ?>>Pending Completion</option>
            </select>
        </div>

        <div style="padding:2px">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="For P.O" <?php echo ($status == 'For P.O') ? 'selected' : ''; ?>>Purchase Request</option>
                <option value="Waiting for Delivery" <?php echo ($status == 'Waiting for Delivery') ? 'selected' : ''; ?>>Purchase Order</option>
                <option value="Check Released" <?php echo ($status == 'Check Released') ? 'selected' : ''; ?>> Purchase Payment</option>
                <option value="All" <?php echo ($status == 'All') ? 'selected' : ''; ?>>All</option>
            </select>
        </div>
        
        <div style="padding:2px">
            <label for="goffice">Government Office:</label>
            <select name="goffice" id="goffice">
                <option value="All" <?php echo ($gOffice == 'All') ? 'selected' : ''; ?>>All</option>
                <option value="1" <?php echo ($gOffice == '1') ? 'selected' : ''; ?>>City</option>
                <option value="2" <?php echo ($gOffice == '2') ? 'selected' : ''; ?>>National</option>
                
            </select>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Average Days</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $totalSum = 0;
    $count = 0;
    $rank = 1;

    while ($row = $record->fetch_assoc()) : 
        $totalSum += $row['Ave'];
        $count++;
    ?>
    <tr>
        <td><?php echo $rank++; ?></td>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo number_format($row['Ave'], 3); ?></td>
    </tr>
    <?php endwhile; ?>

    <?php
    if ($count > 0) {
        $totalAverageDays = $totalSum / $count;
    } else {
        $totalAverageDays = 0;
    }
    ?>
    <tr style ="background-color: #2d6830; font-size:17px;">
        <td colspan="2" style="text-align:right; color: #f3faf3;"><strong>Total Average Days</strong></td>
        <td style="color:white;"><strong><?php echo number_format($totalAverageDays, 3); ?></strong></td>
    </tr>
</tbody>

    </table>
</div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show the loading overlay when the page starts loading
        document.getElementById('loading-overlay').style.display = 'none';
    });

    document.querySelector('form').addEventListener('submit', function () {
        // Show the loading overlay when the form is submitted
        document.getElementById('loading-overlay').style.display = 'flex';
    });

    window.addEventListener('load', function () {
        // Hide the loading overlay when the page is fully loaded
        document.getElementById('loading-overlay').style.display = 'none';
    });
</script>
</html>

