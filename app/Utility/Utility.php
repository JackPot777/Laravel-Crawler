<?php 
namespace App\Utility;

use Carbon\Carbon;

class Utility{
    /**
     *  Break String into a character array, UTF-8 Supported
     *  @input  $string     Input String
     *  @return $array      Output Character String, Each element has 1 character.
     */
    public static function mbStringToArray (string $string){
        $strlen = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string,0,1,"UTF-8");
            $string = mb_substr($string,1,$strlen,"UTF-8");
            $strlen = mb_strlen($string);
        }
        return $array;
    }
    /**
     *  Remove all Chinese Punctuation character.
     *  @input  string $str Input String
     *  @return string      Purified String
     */
    public static function removeChinesePunctuation(string $str){
        return str_replace(
            array('!', '"', '#', '$', '%', '&', '\'', '(', ')', '*',
            '+', ', ', '-', '.', '/', ':', ';', '<', '=', '>',
            '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|',
            '}', '~', '；', '﹔', '︰', '﹕', '：', '，', '﹐', '、',
            '．', '﹒', '˙', '·', '。', '？', '！', '～', '‥', '‧',
            '′', '〃', '〝', '〞', '‵', '‘', '’', '『', '』', '「',
            '」', '“', '”', '…', '❞', '❝', '﹁', '﹂', '﹃', '﹄'),
            '', $str);
    }
    /**
     * Generate all the possible combinations among a set of nested arrays.
     *
     * @param array $data  The entrypoint array container.
     * @param array $all   The final container (used internally).
     * @param array $group The sub container (used internally).
     * @param mixed $val   The value to append (used internally).
     * @param int   $i     The key index (used internally).
     */
    public static function generateCombination(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
    {
        $keys = array_keys($data);
        if (isset($value) === true) {
            array_push($group, $value);
        }

        if ($i >= count($data)) {
            array_push($all, $group);
        } else {
            $currentKey     = $keys[$i];
            $currentElement = $data[$currentKey];
            foreach ($currentElement as $val) {
                self::generateCombination($data, $all, $group, $val, $i + 1);
            }
        }

        return $all;
    }
    /**
     * Print a message in green context in artisan console.
     * @param string $str Input string
     */
    public function info(string $str)
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln('<info>['.Carbon::now().'] '.$str.'</info>');
    }
}
