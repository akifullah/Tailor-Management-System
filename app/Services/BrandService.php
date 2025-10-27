<?php


// app/Services/BrandService.php
namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandService
{
    public function getAll()
    {
        return Brand::latest()->get();
    }

    public function find($id)
    {
        return Brand::find($id);
    }

    public function create($data)
    {
        return Brand::updateOrcreate(
            [$data["id"] ?? null],
            [
                "name" => $data["name"],
                "description" => $data["description"] ?? null,
                "created_by" => Auth::user()->name ?? null,
            ]
        );
    }

    public function update($id, $data)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->update([
                "name" => $data["name"],
                "description" => $data["description"] ?? $brand->description,
            ]);
            return $brand;
        }
        return null;
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return $brand->delete();
        }
        return false;
    }
}
