<?php
if (empty($_SESSION['id'])) 
{
        header('location: ../login.php');
}

if ($_SESSION['role']!='2') 
{
    if ($_SESSION['role']==0)
    {
        header('location: ../employee/index.php');
    }
    if ($_SESSION['role']==1)
    {
        header('location: ../hod/index.php');
    }
}
?> 