<?php
if (empty($_SESSION['id'])) 
{
        header('location: ../login.php');
}
if ($_SESSION['role']!='0') 
{
    if ($_SESSION['role']==2)
    {
        header('location: ../admin/index.php');
    }
    if ($_SESSION['role']==1)
    {
        header('location: ../hod/index.php');
    }
}
?> 