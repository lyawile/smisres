if(isset($_POST[“submit”]))
{
$file = $_FILES[‘file’][‘tmp_name’];
$handle = fopen($file, “r”);
$c = 0;
while(($filesop = fgetcsv($handle, 1000, “,”)) !== false)
{
$name = $filesop[0];
$project = $filesop[1];

$sql = mysql_query(“INSERT INTO mytask (name, project) VALUES (‘$name’,’$project’)”);
$c = $c + 1;
}