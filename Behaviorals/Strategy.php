<?php
interface NamingStrategy
{
    function createName($filename);
}
 
class ZipFileNamingStrategy implements NamingStrategy
{
    function createName($filename)
    {
        return "http://downloads.foo.bar/$filename.zip";
    }
}
 
class TarGzFileNamingStrategy implements NamingStrategy
{
    function createName($filename)
    {
        return "http://downloads.foo.bar/$filename.tar.gz";
    }
}
 
class Context
{
    private $namingStrategy;
    function __construct(NamingStrategy $strategy)
    {
        $this->namingStrategy = $strategy;
    }
    function execute()
    {
        $calc_url = $this->namingStrategy->createName("Calc101");
        $stat_url = $this->namingStrategy->createName("Stat2000");
 
        echo "<h1>The list of downloads</h1>",
            "<br />",
            "<a href=\"$calc_url\">Calculator</a>",
            "<br />",
            "<a href=\"$stat_url\">Statistics application</a>";
    }
} 
 
if (strstr($_SERVER["HTTP_USER_AGENT"], "Win"))
    $context = new Context(new ZipFileNamingStrategy());
else
    $context = new Context(new TarGzFileNamingStrategy());
 
$context->execute();
?>