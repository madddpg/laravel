<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ActivityLog;
use App\Models\Menu;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    private function getMenuPath()
    {
        return public_path('data/menu.json');
    }

    private function syncJsonFile()
    {
        $items = Menu::all(['id', 'name', 'description', 'price', 'image'])->toArray();
        $path = $this->getMenuPath();
        File::put($path, json_encode(['menus' => $items], JSON_PRETTY_PRINT));
    }

    private function logActivity($action, $details = null)
    {
        ActivityLog::create([
            'admin_id' => auth()->guard('admin')->id(),
            'action' => $action,
            'details' => $details,
        ]);
    }

    public function menuIndex()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function menuCreate()
    {
        return view('admin.menu.create');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imageName = 'default.png';
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images'), $imageName);
        }

        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float)$request->price,
            'image' => $imageName,
        ]);

        $this->syncJsonFile();

        $this->logActivity('Created Menu Item', 'Added menu item: ' . $menu->name);

        return redirect()->route('admin.menu.index')->with('success', 'Menu created successfully!');
    }

    public function menuEdit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function menuUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images'), $imageName);
            $menu->image = $imageName;
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float)$request->price,
        ]);

        $this->syncJsonFile();

        $this->logActivity('Updated Menu Item', 'Updated menu ID ' . $id . ': ' . $request->name);

        return redirect()->route('admin.menu.index')->with('success', 'Menu updated successfully!');
    }

    public function menuDestroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menuName = $menu->name;
        $menu->delete();

        $this->syncJsonFile();

        $this->logActivity('Deleted Menu Item', 'Deleted menu ID ' . $id . ' (' . $menuName . ')');

        return redirect()->route('admin.menu.index')->with('success', 'Menu deleted successfully!');
    }

    public function logsIndex()
    {
        $logs = ActivityLog::with('admin')->latest()->get();
        return view('admin.logs.index', compact('logs'));
    }
}
