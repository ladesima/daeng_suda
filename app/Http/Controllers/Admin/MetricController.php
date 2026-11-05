<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    public function index() {
        $metric = Metric::firstOrCreate([]);
        return view('admin.metrics.edit', compact('metric'));
    }
    public function edit(Metric $metric) { return view('admin.metrics.edit', compact('metric')); }
    public function update(Request $r, Metric $metric) {
        $data = $r->validate([
            'districts'=>'required|integer|min:0',
            'villages'=>'required|integer|min:0',
            'sectors'=>'required|integer|min:0',
        ]);
        $metric->update($data);
        return back()->with('ok','Disimpan');
    }
}
