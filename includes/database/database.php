<?php

function selectRows($select, $table, $where, $order, $limit)
{
    global $connect;

    // إعداد الجزء الخاص بالترتيب
    $order = !empty($order) && $order != '*' ? "ORDER BY $order ASC" : '';

    // إعداد الجزء الخاص بالحد
    $limit = !empty($limit) && $limit != '*' ? "LIMIT $limit" : '';

    // إعداد الجزء الخاص بالشروط
    $where = !empty($where) ? "WHERE $where" : '';

    // إنشاء الاستعلام
    $check = "SELECT $select FROM `$table` $where $order $limit";

    // تنفيذ الاستعلام
    $result = mysqli_query($connect, $check);

    // التحقق من وجود خطأ في الاستعلام
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    // إرجاع النتائج
    return $limit == 'LIMIT 1' ? mysqli_fetch_assoc($result) : mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insertRows($table, $data)
{
    global $connect;

    $columns = implode(", ", array_map(function ($col) {
        return "`$col`";
    }, array_keys($data)));

    $values = implode(", ", array_map(function ($value) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $value) . "'";
    }, $data));

    $query = "INSERT INTO `$table` ($columns) VALUES ($values)";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    return $result;
}

function updateRows($table, $data, $where)
{
    global $connect;

    $set = [];
    foreach ($data as $column => $value) {
        $set[] = "`$column`='$value'";
    }
    $setString = implode(", ", $set);

    if (!is_array($where)) {
        $where = [$where];
    }

    $whereString = implode(" AND ", $where);

    $query = "UPDATE `$table` SET $setString WHERE $whereString";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    return $result;
}
