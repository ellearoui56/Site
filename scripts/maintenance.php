<?php
// Enable/disable maintenance mode
if ($argc > 1 && $argv[1] === 'on') {
    touch(BASE_PATH . '/storage/maintenance');
    echo "Maintenance mode ON\n";
} else {
    @unlink(BASE_PATH . '/storage/maintenance');
    echo "Maintenance mode OFF\n";
}