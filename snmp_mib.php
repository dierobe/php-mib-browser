<?php 

function getRemote($ipaddr, $oid, $community, $exp = ":")
{
    /*try {
        $tmp = explode($exp, @snmpget($ipaddr, $community, $oid, 1100000, 2), 2);
        if (!array($tmp)) {
            return null;
        }
        if (count($tmp)  < 2) {
            return null;
        }
        return $tmp[1];
    } catch (Exception $e) {
        return null;
    }*/
    return @snmpget($ipaddr, $community, $oid, 1100000, 2);
}

function walkRemote($ipaddr, $oid, $community){
    
    $html = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>OID</th><th>Value</th></tr></thead>';
    
    // channel ID
    $a = @snmp2_real_walk($ipaddr, $community,$oid, 800000, 2);
    
    if ($a != false){
        
        foreach ($a as $key => $val) {
            $html .= '<tr>';
            $html .= "<td>" . $key . "</td>";
            $html .= "<td>" . $val . "</td>";
            $html .= '</tr>';
        }
        
    }
    $html .= '</tbody></table>';
    return $html;
}

if (isset($_GET['method']) && $_GET['method'] == 'GET'){
    $response = getRemote($_GET['ip'], $_GET['oid'], $_GET['community'], $exp = ":");
    echo $response;
}

if (isset($_GET['method']) && $_GET['method'] == 'WALK'){
    $response = walkRemote($_GET['ip'], $_GET['oid'], $_GET['community']);
    echo $response;
}


?>