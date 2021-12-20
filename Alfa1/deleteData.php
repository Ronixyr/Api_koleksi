<?php

parse_str(file_get_contents("php://input"), $_DELETE);
echo $_DELETE['nama'];
?>