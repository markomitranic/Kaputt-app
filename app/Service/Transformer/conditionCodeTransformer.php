<?php

namespace Service\Transformer;

class conditionCodeTransformer
{

    const SNOW = ['1066', '1072', '1114', '1117', '1204', '1207', '1210', '1213', '1216', '1219', '1222', '1225', '1237', '1255', '1258', '1279', '1282'];
    const RAIN = ['1063', '1153', '1168', '1171', '1183', '1186', '1189', '1192', '1195', '1198', '1201', '1240', '1243', '1246', '1249', '1252', '1261', '1264', '1273', '1276'];

    /**
     * @param int $apiCode
     * @return int
     */
    public function transform($apiCode)
    {

        if (in_array($apiCode, self::SNOW)) {
            return 1;
        }

        if (in_array($apiCode, self::RAIN)) {
            return 2;
        }

        return 0;
    }
}