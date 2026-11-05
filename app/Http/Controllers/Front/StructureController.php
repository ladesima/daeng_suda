<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class StructureController extends Controller
{
    public function show()
    {
        // Ambil semua pegawai dengan relasi atasan dan bawahan
        $emps = Employee::with(['atasan', 'bawahan'])
            ->orderBy('atasan_id')
            ->orderBy('id')
            ->get();

        // 1) siapkan node
        $nodes = [];
        $parent = [];
        foreach ($emps as $e) {
            $nodes[$e->id] = [
                'id'       => $e->id,
                'title'    => $e->jabatan,
                'name'     => $e->nama,
                'nip'      => $e->nip,
                'photo'    => $e->photo_url,
                'children' => [],
            ];
            $parent[$e->id] = $e->atasan_id;
        }

        // 2) rangkai menjadi tree
        $tree = [];
        foreach ($nodes as $id => &$node) {
            $pid = $parent[$id];
            if ($pid && isset($nodes[$pid])) {
                $nodes[$pid]['children'][] = &$node;
            } else {
                $tree[] = &$node; // root
            }
        }
        unset($node);

        return view('front.structure', [
            'tree'      => $tree,
            'employees' => $emps,
        ]);
    }
}
