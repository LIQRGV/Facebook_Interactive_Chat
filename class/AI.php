<?php
date_default_timezone_set("Asia/Jakarta");
/**
 * @author Ammar F. https://www.facebook.com/ammarfaizi2 <ammarfaizi2@gmail.com>
 * @license RedAngel_PHP_Concept (c) 2017
 * @package Artificial Intelegence
 */
include_once('tools/Whois/Whois.php');
include_once('tools/SaferScript.php');
include_once('tools/Translator.php');
include_once('tools/Brainly.php');
include_once('tools/Saklar.php');
use tools\SaferScript;
use tools\Translator;
use tools\Brainly;
use tools\Saklar;
class AI
{
    private $jam;
    private $sapa;
    private $jadwal;
    private $hari;
    private function ttreturn($key)
    {
        if (isset($this->wordlist[$key])) {
            foreach ($this->wordlist[$key] as $key => $val) {
                foreach ($val as $ky => $vl) {
                    $a  = explode(",", $ky);
                    $tr = array();
                    foreach ($a as $b) {
                        $b = explode("-", $b);
                        if (count($b) == 2) {
                            foreach (range($b[0], $b[1]) as $tmg) {
                                $tr[] = $tmg;
                            }
                        } else {
                            $tr[] = (int) $b[0];
                        }
                    }
                    var_dump($tr);
                    if (in_array(date("H", $this->gtime), $tr)) {
                        return $vl[array_rand($vl)];
                        break;
                    }
                }
            }
        }
        return false;
    }
    public function __construct()
    {
        $this->gtime        = strtotime(date("Y-m-d H:i:s"));
        $this->wordlist     = array(
            "hai,haii,hi,hii,hy,hyy,hay" => array(
                array(
                    "hai juga ^@"
                ),
                true,
                false,
                null,
                6,
                35,
                null
            ),

            "halo,hallo,allo,helo,hola,ello" => array(
                array(
                    "halo juga ^@"
                ),
                true,
                false,
                null,
                6,
                35,
                null
            ),

            "pagi" => array(
                array(
                    "0-9,24" => array(
                        "selamat pagi kang  ^@, selamat beraktiftas"
                    ),
                    "10-11" => array(
                        "selamat pagi menjelang siang ^@"
                    ),
                    "12-14" => array(
                        "ini udah siang kang ^@ :v"
                    ),
                    "15-18" => array(
                        "ini udah sore kang ^@"
                    ),
                    "19-23" => array(
                        "ini udah malem kang ^@"
                    )
                ),
                false,
                true,
                null,
                6,
                35,
                null
            ),

            "siang,ciang,siank" => array(
                array(
                    "0-9,24" => array(
                        "ini masih pagi kang ^@"
                    ),
                    "10-15" => array(
                        "selamat siang kang ^@, selamat beraktifitas"
                    ),
                    "16-18" => array(
                        "ini udah sore kang ^@"
                    ),
                    "19-23" => array(
                        "ini udah malem kang ^@"
                    )
                ),
                true,
                true,
                null,
                6,
                35,
                null
            ),

            "sore" => array(
                array(
                    "0-9,24" => array(
                        "ini masih pagi kang ^@"
                    ),
                    "10-14" => array(
                        "ini masih siang kang ^@"
                    ),
                    "15-18" => array(
                        "selamat sore kang ^@, selamat beristirahat"
                    ),
                    "19-23" => array(
                        "ini udah malem kang ^@"
                    )
                ),
                true,
                true,
                null,
                6,
                35,
                null
            ),

            "malam,malem" => array(
                array(
                    "0-9,24" => array(
                        "ini masih pagi kang ^@"
                    ),
                    "10-14" => array(
                        "ini masih siang kang ^@"
                    ),
                    "15-18" => array(
                        "ini masih sore kang ^@"
                    ),
                    "19-23" => array(
                        "selamat malam kang ^@, selamat beristirahat"
                    )
                ),
                true,
                true,
                null,
                6,
                35,
                null
            ),

            "apa+kabar" => array(
                array(
                    "kabar baik disini",
                    "baik",
                    "sehat"
                ),
                false,
                false,
                null,
                6,
                35,
                null
            ),

            "jam+brp,jam+berapa,jm+brp,jm+berapa" => array(
                array(
                    "sekarang jam #d(jam) #d(sapa)"
                ),
                true,
                false,
                null,
                5,
                35,
                null
            ),

            "hari+apa+besok" => array(
                array(
                    "besok hari #d(day+1day)"
                ),
                true,
                false,
                null,
                10,
                45,
                null
            ),

            "hari+apa+kemarin" => array(
                array(
                    "kemarin hari #d(day-1day)"
                ),
                true,
                false,
                null,
                10,
                45,
                null
            ),

            "hari+apa" => array(
                array(
                    "sekarang hari #d(day)"
                ),
                false,
                false,
                null,
                10,
                45,
                null
            ),

            "makasih,terima+kasih,thank" => array(
                array(
                    "sama sama 😉",
                    "welcome 😃",
                    "all right 😉"
                ),
                false,
                false,
                null,
                5,
                35,
                null
            ),

            "kleng" => array(
                array(
                    "sokleng baso tengkleng"
                ),
                true,
                false,
                null,
                4,
                20,
                null
            ),

            "zeeb,zeev" => array(
                array(
                    "zeeb (y)",
                    "zeeb :*"
                ),
                true,
                false,
                null,
                4,
                15,
                null
            ),

            "ntap" => array(
                array(
                    "mantapzz (y)",
                    "ntapzz (y)",
                    "mantap"
                ),
                false,
                false,
                null,
                5,
                25,
                null
            ),

            "haha,wkwk,xixi,xexe,wkaka,wkeke,wkoko" => array(
                array(
                    "dilarang ketawa"
                ),
                false,
                false,
                null,
                5,
                45,
                null
            ),

            "laper,lapar" => array(
                array(
                    "kalo laper ya makan :p"
                ),
                true,
                false,
                null,
                5,
                25,
                null
            ),

            ":v,:'v,v':,v:,:\"v" => array(
                array(
                    "lu laper sampe mangap mangap gitu?",
                    "kenapa ^@, laper tha?"
                ),
                true,
                false,
                null,
                2,
                4,
                null
            ),

            "bot" => array(
                array(
                    "apa kang ^@?"
                ),
                true,
                false,
                null,
                2,
                10,
                null
            )


        );
        $this->jam          = array(
            '#01',
            '#02',
            '#03',
            '#04',
            '#05',
            '#06',
            '#07',
            '#08',
            '#09',
            '#10',
            '#11',
            '#12',
            '#13',
            '#14',
            '#15',
            '#16',
            '#17',
            '#18',
            '#19',
            '#20',
            '#21',
            '#22',
            '#23',
            '#24',
            '#00'
        );
        $this->sapa         = array(
            'dini hari',
            'dini hari',
            'dini hari',
            'dini hari',
            'pagi',
            'pagi',
            'pagi',
            'pagi',
            'pagi',
            'menjelang siang',
            'siang',
            'siang',
            'siang',
            'siang',
            'sore',
            'sore',
            'sore',
            'sore',
            'malam',
            'malam',
            'malam',
            'malam',
            'malam',
            'dini hari',
            'dini hari'
        );
        $this->jadwal       = array(
            "Senin" => "Senin\n\nBiologi\nKewirausahaan\nMatematika\nMatematika\nKimia\nKimia\nFisika\n\nPulang jam 16.00",
            "Selasa" => "Selasa\n\nGeografi\nGeografi\nEkonomi\nEkonomi\nMatematika\nSeni Budaya\nAgama\nKeiran (Japan)\n\nPulang jam 16.30",
            "Rabu" => "Rabu\n\nB.Indonesia\nB.Indonesia\nB.Inggris\nB.Inggris\nBiologi\nBiologi\nAgama\nMatematika\nMatematika\n\nPulang jam 15.30",
            "Kamis" => "Kamis\n\nOlahraga\nOlahraga\nOlahraga\nGeografi\nB.Indonesia\nPKN\nFisika\nFisika\n\nPulang jam 15.30",
            "Jum'at" => "Jum'at\n\nSenam\nMatematika\nMatematika\nKimia\nSejarah\nSejarah\n\nPulang jam 11.00",
            "Sabtu" => "Sabtu\n\nPKN\nEkonomi\nB.Jawa\nPramuka(jarang)\nPramuka(jarang)\n\nPulang jam 11.00",
            "Minggu" => "Minggu\n\nNgisi kuliah kalsel\nNgisi kuliah Surabaya\nNgisi kuliah umum\nBebas"
        );
        $this->superuser    = array(
            "Ammar Faizi"
        );
        $this->hari         = array(
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jum'at",
            "Sabtu"
        );
        $this->root_command = array(
            "off" => 2,
            "on" => 2,
            "shexec" => 1,
            "shell_exec" => 1,
            "eval" => 1
        );
        $this->command      = array(
            "ask" => 2,
            "saklar" => 2,
            "translate" => 2,
            "ctranslate" => 3,
            "whois" => 1,
            "hitung" => 1,
            "jadwal" => 1,
            "lampu" => 2
        );
    }
    private function word_check($needle, $haystack, $word_identical = false, $trreply = false, $timerange = null, $max_words = null, $max_length = null, $word_exception = null)
    {
        if (is_array($timerange) && !in_array((int) date("H", $this->gtime), $timerange)) {
            return false;
        }
        if ($max_length !== null && strlen($haystack) > (int) $max_length) {
            return false;
        }
        $stex = explode(" ", $haystack);
        if ($max_words !== null && count($stex) > $max_words) {
            return false;
        }
        if (is_array($word_exception)) {
            foreach ($stex as $val1) {
                foreach ($word_exception as $val2) {
                    if ($val1 == $val2) {
                        return false;
                        break;
                    }
                }
            }
        }
        $nd  = explode(",", $needle);
        $sts = false;
        $wcheck = function($qx, $hy, $wi = false)
        {
            $jl = 0;
            if ($wi === true) {
                foreach ($hy as $t) {
                    foreach ($qx as $r) {
                        if ($t == $r) {
                            $jl++;
                        }
                    }
                }
            } else {
                foreach ($qx as $p0x) {
                    if (strpos($hy, $p0x) !== false) {
                        $jl++;
                    }
                }
            }
            return $jl >= count($qx) ? true : false;
        };
        if ($word_identical === true) {
            foreach ($nd as $q) {
                $qx = explode("+", $q);
                foreach ($stex as $p) {
                    if ((count($qx) > 1 ? $wcheck($qx, $stex, true) : $p == $q)) {
                        $br  = true;
                        $sts = true;
                        break;
                    }
                }
                if ($q == $haystack) {
                    $sts = true;
                    break;
                }
                if (isset($br) && $br === true) {
                    break;
                }
            }
        } else {
            foreach ($nd as $q) {
                $qx = explode("+", $q);
                foreach ($stex as $p) {
                    if ((count($qx) > 1 ? $wcheck($qx, $haystack, false) : (strpos($haystack, $q) !== false))) {
                        $sts = true;
                        break;
                    }
                }
            }
        }
        if ($sts !== true) {
            return false;
        }
        return $trreply === true ? $this->ttreturn($needle) : $this->wordlist[$needle][0][array_rand($this->wordlist[$needle][0])];
    }
    public function prepare($string)
    {
        $this->msg  = strtolower($string);
        $this->_msg = $string;
        return $this;
    }
    public function spwcmd($string, $actor = null)
    {
        $a          = explode(" ", $this->_msg, 2);
        $this->_msg = $a[1];
        if (isset($this->root_command[$string]) && in_array($actor, $this->superuser)) {
            $a = null;
            switch ($string) {
                case "on":
                    $cf  = file_exists("bot_off");
                    $msg = ($cf ? "bot_on" : "~");
                    if ($cf) {
                        unlink("bot_off");
                        $msg = file_exists("bot_off") ? "error" : $msg;
                    }
                    break;
                case "off":
                    $cf  = file_exists("bot_off");
                    $msg = ($cf ? "~" : "bot_off");
                    !$cf AND file_put_contents("bot_off", "");
                    break;
                case "shexec":
                    $msg = shell_exec($this->_msg);
                    $msg = empty($msg) ? "~" : $msg;
                    break;
                case "shell_exec":
                    $msg = shell_exec($this->_msg);
                    $msg = empty($msg) ? "~" : $msg;
                    break;
                case "eval":
                    $ls = new SaferScript($this->_msg);
                    $ls->allowHarmlessCalls();
                    $error  = $ls->parse(true);
                    $return = $ls->execute();
                    $ls     = null;
                    $msg    = (isset($error[0]) ? $error[0] : (empty($return) ? "success !" : $return));
                    break;
                default:
                    $msg = false;
                    break;
            }
        } else if (isset($this->root_command[$string])) {
            $msg = "Permission Dennied : " . $actor;
        } else if (isset($this->command[$string])) {
            switch ($string) {
                case 'ask':
                    $ask = function($query)
                    {
                        $a     = new Brainly();
                        $b     = $a->execute($query, 100);
                        $a     = null;
                        $query = explode(" ", $query);
                        $ctn   = 0;
                        foreach ($b['result'] as $val) {
                            $bb[$ctn] = 0;
                            foreach ($query as $val2) {
                                if (strpos($val[0], $val2) !== false) {
                                    ++$bb[$ctn];
                                }
                            }
                            ++$ctn;
                        }
                        return (($b['result'][array_search(max($bb), $bb)]));
                    };
                    $a   = $ask($this->_msg);
                    if (empty($a[0]) || empty($a[1])) {
                        $a = "Mohon maaf, saya tidak bisa menjawab pertanyaan \"" . $action . "\"";
                    } else {
                        $a = "Hasil pencarian dari pertanyaan ^@\n\nPertanyaan yang mirip :\n" . $a[0] . "\n\nJawaban :\n" . $a[1] . "\n\n\n";
                    }
                    $actor = explode(" ", $actor);
                    $a     = str_replace("^@", $actor[0], $a);
                    $a     = str_replace("@", implode(" ", $actor), $a);
                    $a     = str_replace($this->jam, $this->sapa, $a);
                    $a     = str_replace("<br />", PHP_EOL, $a);
                    $a     = html_entity_decode(strip_tags($a), ENT_QUOTES, 'UTF-8');
                    $msg   = $a;
                    break;
                case 'translate':
                    $translator = new Translator();
                    $jsonMsg    = $translator->translate($this->_msg);
                    if($jsonMsg->code == 200) {
                        $msg = $jsonMsg->text[0];
                    } else {
                        $msg = "({$jsonMsg->code}) Terjadi kesalahan pada server";
                    }
                    break;
                case 'ctranslate':
                    $param = explode(" ", $this->_msg);
                    if (strlen($param[0]) == 2 || strlen($param[1]) == 2) {
                        $par = $param[0] . "," . $param[1];
                        unset($param[0], $param[1]);
                        $translator = new Translator();
                        $jsonMsg = $translator->translate(implode(" ", $param), $par);
                        if($jsonMsg->code == 200) {
                            $msg = $jsonMsg->text[0];
                        } else {
                            $msg = "({$jsonMsg->code}) Terjadi kesalahan pada server";
                        }
                    } else {
                        $msg = "Mohon maaf, penulisan parameter custom translate salah.\n\nPenulisan yang benar :\nctranslate [from] [to] [string]\n\nContoh:\nctranslate en id 'how are you?'";
                    }
                    break;
                case 'hitung':
                    $a  = array(
                        "x"
                    );
                    $b  = array(
                        "*"
                    );
                    $ls = new SaferScript('$q = ' . str_replace($a, $b, $this->_msg) . ';');
                    $ls->allowHarmlessCalls('hitung');
                    $error  = $ls->parse();
                    $return = $ls->execute();
                    $ls     = null;
                    $msg    = (isset($error[0]) ? $error[0] : (empty($return) ? "Perhitungan tidak ditemukan !" : $return));
                    break;
                case 'jadwal':
                    $this->_msg = strtolower($this->_msg);
                    foreach ($this->jadwal as $z => $g) {
                        $z = strtolower($z);
                        if (strpos($this->_msg, $z) !== false) {
                            $msg = "Jadwal Hari " . $g;
                            break;
                        }
                    }
                    break;
                case 'saklar':
                    $b = explode(" ", $this->_msg);
                    if (preg_match("#[^0-4\,]#", $b[0]) OR !in_array($b[1], array(
                        "on",
                        "off"
                    ))) {
                        $msg = "Mohon maaf kang, penulisan perintah saklar salah\n\saklar [int] [on/off]";
                    } else {
                        $b[1] = str_ireplace(array(
                            "on",
                            "off"
                        ), array(
                            0,
                            1
                        ), $b[1]);
                        $a    = new saklar();
                        $a->saklar($b[0], $b[1]);
                        $a->get_image();
                        $msg = array(
                            'img',
                            'lampu.jpg',
                            "siap kang !\n" . $a->get_status()
                        );
                    }
                    break;
                case 'lampu':
                    if ($this->_msg == "status") {
                        $a = new saklar();
                        $a->get_image();
                        $msg = array(
                            'img',
                            'lampu.jpg',
                            $a->get_status()
                        );
                        break;
                    }
            }
        }
        return isset($msg) ? $msg : false;
    }
    public function execute($actor = "")
    {
        $opmsg = explode(" ", $this->msg);
        $opmsg = strtolower($opmsg[0]);
        foreach ($this->root_command as $q => $val) {
            if ($opmsg == $q) {
                $this->absmsg = true;
                $this->msg    = null;
                $this->msgrt  = $this->spwcmd($q, $actor);
                $this->actor  = $actor;
                return true;
                break;
            }
        }
        foreach ($this->command as $q => $z) {
            if ($opmsg == $q) {
                $this->absmsg = true;
                $this->msg    = null;
                $this->msgrt  = $this->spwcmd($q, $actor);
                $this->actor  = $actor;

                return true;
                break;
            }
        }
        if (file_exists("bot_off")) {
            $this->absmsg = false;
            $this->msg    = null;
            $this->msgrt  = null;
            $this->actor  = null;
            return false;
        }
        foreach ($this->wordlist as $key => $val) {
            if ($r = $this->word_check($key, $this->msg, (isset($val[1]) ? $val[1] : false), (isset($val[2]) ? $val[2] : false), (isset($val[3]) ? $val[3] : null), (isset($val[4]) ? $val[4] : null), (isset($val[5]) ? $val[5] : null))) {
                $this->absmsg = false;
                $this->msg    = null;
                $this->msgrt  = $r;
                $this->actor  = $actor;
                return true;
                break;
            }
        }
        $this->absmsg = false;
        $this->msg    = null;
        $this->msgrt  = null;
        $this->actor  = null;
        return false;
    }
    private function fix_rp($str)
    {
        $hari = $this->hari[(int) date('w')];
        $str  = str_replace($this->jam, $this->sapa, $str);
        $str  = str_replace("#d(day)", $hari, $str);
        return $str;
    }
    public function fetch_reply()
    {
        if (!isset($this->absmsg)) {
            throw new Exception("Prepared statement not executed yet !", 3);
        }
        if ($this->absmsg == false) {
            $shact = explode(" ", $this->actor);
            $rt    = str_replace("^@", $shact[0], $this->msgrt);
            $rt    = str_replace("@", $this->actor, $rt);
            $rt    = str_replace($this->jam, $this->sapa, $rt);
            $rt    = $this->fix_rp($rt);
        } else {
            $rt = $this->msgrt;
        }
        return empty($rt) ? false : $rt;
    }
}
