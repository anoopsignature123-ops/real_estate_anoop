<?php

namespace App\Services;

use App\Models\Source;

class SourceService
{
    public function getAll()
    {
        return Source::latest()->get();
    }

    public function store($data)
    {
        return Source::create([
            'name' => $data['name'],
        ]);
    }

    public function findById($id)
    {
        return Source::findOrFail($id);
    }

    public function update($data, $id)
    {
        $source = $this->findById($id);

        $source->update([
            'name' => $data['name'],
        ]);

        return $source;
    }

    public function delete($id)
    {
        $source = $this->findById($id);

        return $source->delete();
    }
}
