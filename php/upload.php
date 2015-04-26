<?php  

$target = "u/"; 

$target =$target.basename($_FILES['InputFile']['name']) ; 
$ft = pathinfo($target,PATHINFO_EXTENSION);
echo $ft."\n";
$ok=1; 
if (file_exists($target)) {
    echo "Sorry, file already exists.";
    $ok = 0;}
if ($_FILES["InputFile"]["size"] > 6000000) {
 echo "<script>alert('Your file is too large.'</script>"; }
 
if($ok==0)
{
	echo "<script>alert('Sorry, your file was not InputFile.'</script>"
	}

else {
if(move_uploaded_file($_FILES['InputFile']['tmp_name'], $target)) 
{  


echo "The file ".basename($_FILES['InputFile']['name'])." has been InputFile"; }
 
else { echo "<script>alert('Sorry, there was a problem uploading your file.'</script>"; }
}
?>