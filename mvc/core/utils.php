<?php

function isValidJSON($body)
{ // verifica daca datele JSON sunt corecte
    json_decode($body);
    return json_last_error() == JSON_ERROR_NONE;
}
