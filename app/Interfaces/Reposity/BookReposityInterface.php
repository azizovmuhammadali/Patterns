<?php

namespace App\Interfaces\Reposity;

interface BookReposityInterface
{
    public function index();
    public function create($data);
    public function show($id);
    public function update($id, $data);
    public function destroy($id);
}
