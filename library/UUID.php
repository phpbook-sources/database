<?php namespace PHPBook\Database;

abstract class UUID {
    
    public static function generate($prefix = '', $node = null) {
        
        // nano second time (only micro second precision) since start of UTC
        $time = microtime(true) * 10000000 + 0x01b21dd213814000;
        $time = pack("H*", sprintf('%016x', $time));
        $sequence = random_bytes(2);
        $sequence[0] = chr(ord($sequence[0]) & 0x3f | 0x80);   // variant bits 10x
        $time[0] = chr(ord($time[0]) & 0x0f | 0x10);           // version bits 0001
        if (!empty($node)) {
            // non hex string identifier
            if (is_string($node) && preg_match('/[^a-f0-9]/is', $node)) {
                // base node off md5 hash for sequence
                $node = md5($node);
                // set multicast bit not IEEE 802 MAC
                $node = (hexdec(substr($node, 0, 2)) | 1) . substr($node, 2, 10);
            }
            if (is_numeric($node))
                $node = sprintf('%012x', $node);
            $len = strlen($node);
            if ($len > 12)
                $node = substr($node, 0, 12);
            else if ($len < 12)
                $node .= str_repeat('0', 12 - $len);
        } else {
            // base node off random sequence
            $node = random_bytes(6);
            // set multicast bit not IEEE 802 MAC
            $node[0] = chr(ord($node[0]) | 1);
            $node = bin2hex($node);
        }
        return $prefix . bin2hex($time[4] . $time[5] . $time[6] . $time[7]) // time low
            . '-' . bin2hex($time[2] . $time[3])                // time med
            . '-' . bin2hex($time[0] . $time[1])                // time hi
            . '-' . bin2hex($sequence)                          // seq
            . '-' . $node;                                      // node


    }
  
}