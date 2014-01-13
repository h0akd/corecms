<?php

namespace H0akd\Corecms\Helpers;

use H0akd\Corecms\Models\Configuration;
use Illuminate\Database\Eloquent\Model;
use \Exception;

class UserConfiguration {

    /**
     * Hàm lấy ra user config
     * @param string $name tên của config
     * @param string $default giá trị mặc định
     * @param boolean $auto_save lưu lại giá trị mặc định vào database
     * @return mixed giá trị mặc định hoặc giá trị config 
     * @throws Exception
     */
//    public function get($group, $name, $default = "", $auto_save = true) {
//        Model::unguard();
//        $result = $default;
//        $configuration = Configuration::where("name", "=", $group)->first();
//        if ($configuration !== null) {
//            echo "configuration != null";
//            $configs = json_decode($configuration->config, 1);
//            dump_var($configs);
//            $result = isset($configs[$name]) ? $configs[$name] : $default;
//            dump_var($result);
//        }
//       
//        if ($default !== $result && $auto_save) {
//            $this->set($group, $name, $default);
//        }
//        return $default;
//    }

    /**
     * 
     * @param String $name
     * @param String $value
     * @return Boolean true if success and failed if error
     * @throws Exception
     */
    public function set($group, $name, $value) {
        die("$group,$name,$value");
        $configuration = Configuration::where("name", "=", $group)->first();
        if ($configuration == null) {
            $model = new Configuration(array("name" => $group, "config" => json_encode(array($name => $value))));
            return $model->save();
        } else if (!isset($configuration->config) || $configuration->config === "") {
            $configuration->config = json_encode(array($name => $value));
            return $configuration->save();
        } else {
            $configs = json_decode($configuration->config, 1);
            $configs[$name] = $value;
            $configuration->config = json_encode($configs);
            return $configuration->save();
        }
    }

}
