<?php


namespace App\Repositories;


interface PostRepositoryInterface
{
    public function selectAll();
    public function find($id);

}