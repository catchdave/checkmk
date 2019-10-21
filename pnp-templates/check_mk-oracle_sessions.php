<?php
# +------------------------------------------------------------------+
# |             ____ _               _        __  __ _  __           |
# |            / ___| |__   ___  ___| | __   |  \/  | |/ /           |
# |           | |   | '_ \ / _ \/ __| |/ /   | |\/| | ' /            |
# |           | |___| | | |  __/ (__|   <    | |  | | . \            |
# |            \____|_| |_|\___|\___|_|\_\___|_|  |_|_|\_\           |
# |                                                                  |
# | Copyright Mathias Kettner 2014             mk@mathias-kettner.de |
# +------------------------------------------------------------------+
#
# This file is part of Check_MK.
# The official homepage is at http://mathias-kettner.de/check_mk.
#
# check_mk is free software;  you can redistribute it and/or modify it
# under the  terms of the  GNU General Public License  as published by
# the Free Software Foundation in version 2.  check_mk is  distributed
# in the hope that it will be useful, but WITHOUT ANY WARRANTY;  with-
# out even the implied warranty of  MERCHANTABILITY  or  FITNESS FOR A
# PARTICULAR PURPOSE. See the  GNU General Public License for more de-
# tails. You should have  received  a copy of the  GNU  General Public
# License along with GNU Make; see the file  COPYING.  If  not,  write
# to the Free Software Foundation, Inc., 51 Franklin St,  Fifth Floor,
# Boston, MA 02110-1301 USA.

$warn = $WARN[1];
$crit = $CRIT[1];

$title = str_replace("_", " ", $servicedesc);
$opt[1] = "--vertical-label 'active sessions' -l0 --title \"$title\" ";
if (is_numeric($crit)) {
    $opt[1] .= "-u $crit ";
}

$def[1] = "DEF:sessions=$RRDFILE[1]:$DS[1]:MAX ";
$def[1] .= "AREA:sessions#00ff48: ";
$def[1] .= "LINE:sessions#008f38: ";
$def[1] .= "GPRINT:sessions:LAST:\"last\: %3.0lf\" ";
$def[1] .= "GPRINT:sessions:AVERAGE:\"avg\: %3.0lf\" ";
$def[1] .= "GPRINT:sessions:MAX:\"max\: %3.0lf\" ";
if (is_numeric($warn)) {
    $def[1] .= "HRULE:$warn#ffcf00:\"Warning at $warn\" ";
}
if (is_numeric($crit)) {
    $def[1] .= "HRULE:$crit#ff0000:\"Critical at $crit\" ";
}
?>