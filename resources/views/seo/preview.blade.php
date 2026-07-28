@php($data = $getState())

<div class="space-y-1 rounded-md border border-gray-300" style="padding: 10px;">
    <div class="p-10">
        <div class="text-blue-700! text-lg font-medium">
            {{ $data['title'] ?? '' }}
        </div>

        <div class="text-green-700! text-sm">
            {{ $data['url'] ?? '' }}
        </div>

        <div class="text-black! text-sm">
            {{ $data['description'] ?? '' }}
        </div>
    </div>
</div>
