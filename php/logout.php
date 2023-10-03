<?php
session_start();
session_abort();
session_reset();
header('Location:../index.html');
