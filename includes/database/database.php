<?php

function selectRows($select, $table, $where, $order, $limit)
{
    global $connect;

    if (!empty($order) && $order != '*') {
        $order = "ORDER BY $order ASC";
    } else {
        $order = '';
    }

    if (!empty($limit) && $limit != '*') {
        $limit = "LIMIT $limit";
    } elseif (empty($limit)) {
        $limit = "LIMIT 3";
    } elseif ($limit == '*') {
        $limit = '';
    }

    if (!empty($where) && $where != '*') {
        $where = "WHERE $where";
    } else {
        $where = '';
    }

    $check = "SELECT $select FROM `$table` $where $order $limit";
    $result = mysqli_query($connect, $check);

    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    if ($limit == 'LIMIT 1') {
        return mysqli_fetch_assoc($result) ?? [];
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC) ?? [];
    }
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

    $whereString = implode(" AND ", $where);

    $query = "UPDATE `$table` SET $setString WHERE $whereString";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    return $result;
}
