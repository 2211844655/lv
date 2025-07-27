<div class="container mx-auto p-4">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">تقارير المشاريع</h2>
    <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إضافة مشروع</a>
  </div>

  <div class="mb-4">
    <form method="GET" action="{{ route('projects.index') }}">
      <select name="filter" onchange="this.form.submit()" class="border rounded p-2">
        <option value="">عرض جميع المشاريع</option>
        @foreach($projects as $proj)
          <option value="{{ $proj->id }}" {{ request('filter') == $proj->id ? 'selected' : '' }}>عرض: {{ $proj->name }}</option>
        @endforeach
      </select>
    </form>
  </div>

  <table class="min-w-full bg-white border">
    <thead>
      <tr>
        <th class="px-6 py-3 border-b">الاسم</th>
        <th class="px-6 py-3 border-b">الوصف</th>
        <th class="px-6 py-3 border-b">الحالة</th>
        <th class="px-6 py-3 border-b">العمليات</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projectsToShow as $project)
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 border-b">{{ $project->name }}</td>
          <td class="px-6 py-4 border-b">{{ Str::limit($project->description, 50) }}</td>
          <td class="px-6 py-4 border-b">{{ $project->status }}</td>
          <td class="px-6 py-4 border-b">
            <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-600 hover:underline">تعديل</a> |
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('هل أنت متأكد؟')" class="text-red-600 hover:underline">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
