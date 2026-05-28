<x-filament-panels::page>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    
    <style>
        .kanban-scrollable {
            overflow-x: auto;
            overflow-y: hidden;
            padding: 20px 0 150px 0;
            margin: -20px 0 -130px 0;
        }
        .kanban-scrollable::-webkit-scrollbar {
            height: 12px;
        }
        .kanban-scrollable::-webkit-scrollbar-track {
            background: rgb(31 41 55);
            border-radius: 0;
        }
        .kanban-scrollable::-webkit-scrollbar-thumb {
            background: rgb(75 85 99);
            border-radius: 6px;
        }
        .kanban-scrollable::-webkit-scrollbar-thumb:hover {
            background: rgb(107 114 128);
        }
        .kanban-columns {
            display: flex;
            gap: 1.25rem;
            padding: 0 4px 130px 4px;
        }
        .kanban-column-wrapper {
            flex: 0 0 340px;
            display: flex;
            flex-direction: column;
        }
        .kanban-column {
            flex: 1;
            min-height: 0;
            max-height: calc(100vh - 320px);
            overflow-y: auto;
            padding-right: 4px;
        }
        .kanban-column::-webkit-scrollbar {
            width: 6px;
        }
        .kanban-column::-webkit-scrollbar-track {
            background: transparent;
        }
        .kanban-column::-webkit-scrollbar-thumb {
            background: rgb(75 85 99);
            border-radius: 3px;
        }
        .kanban-column::-webkit-scrollbar-thumb:hover {
            background: rgb(107 114 128);
        }
        .sortable-ghost {
            opacity: 0.5;
            background: rgb(59 130 246 / 0.2);
            border: 2px dashed rgb(59 130 246);
        }
        .kanban-card {
            transition: all 0.2s ease;
            border: 2px solid rgb(75 85 99) !important;
            padding: 1.25rem !important;
            cursor: pointer !important;
        }
        .kanban-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.3);
            border: 2px solid rgb(107 114 128) !important;
        }
        .kanban-card:active {
            transform: translateY(0);
        }
        .kanban-card.in-progress {
            border: 2px solid rgb(234 179 8) !important;
        }
        .kanban-card.in-progress:hover {
            border: 2px solid rgb(250 204 21) !important;
        }
        .kanban-card.done {
            border: 2px solid rgb(34 197 94) !important;
        }
        .kanban-card.done:hover {
            border: 2px solid rgb(74 222 128) !important;
        }
        .kanban-card h4 {
            margin-bottom: 0.5rem !important;
            line-height: 1.5 !important;
        }
        .kanban-card .card-content {
            margin-bottom: 1rem !important;
        }
        .kanban-card .card-footer {
            padding-top: 1rem !important;
            margin-top: 0.25rem !important;
        }
        .kanban-card.in-progress {
            border-color: rgb(234 179 8 / 0.3) !important;
        }
        .kanban-card.in-progress:hover {
            border-color: rgb(234 179 8 / 0.5) !important;
        }
        .kanban-card.done {
            border-color: rgb(34 197 94 / 0.2) !important;
        }
        .kanban-card.done:hover {
            border-color: rgb(34 197 94 / 0.3) !important;
        }
    </style>

    <div class="kanban-scrollable">
        <div class="kanban-columns">
            {{-- To Do Column --}}
            <div class="kanban-column-wrapper">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-4 mb-4 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">To Do</h3>
                                <span class="text-xs text-gray-400">{{ count($toDoProjects) }} tasks</span>
                            </div>
                        </div>
                        <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('create') }}" 
                           class="w-8 h-8 rounded-lg bg-gray-700 hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="kanban-column space-y-4 px-1" data-status="to_do">
                    @forelse($toDoProjects as $project)
                        <div class="kanban-card bg-gray-800/90 backdrop-blur-sm rounded-xl p-5 cursor-grab active:cursor-grabbing shadow-md" data-id="{{ $project['id'] }}">
                            <div class="card-content flex items-start gap-3 mb-4">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white text-sm mb-1.5 leading-tight">
                                        {{ $project['title'] }}
                                    </h4>
                                    @if($project['description'])
                                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">
                                            {{ $project['description'] }}
                                        </p>
                                    @endif
                                </div>
                                @if($project['priority'])
                                    <span class="text-[10px] px-2 py-1 rounded-md font-semibold uppercase tracking-wide
                                        @if($project['priority'] === 'urgent') bg-red-500/20 text-red-300 ring-1 ring-red-500/30 @endif
                                        @if($project['priority'] === 'high') bg-orange-500/20 text-orange-300 ring-1 ring-orange-500/30 @endif
                                        @if($project['priority'] === 'medium') bg-yellow-500/20 text-yellow-300 ring-1 ring-yellow-500/30 @endif
                                        @if($project['priority'] === 'low') bg-green-500/20 text-green-300 ring-1 ring-green-500/30 @endif">
                                        {{ $project['priority'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col gap-3 pt-3 border-t border-gray-700/50">
                                @if($project['deadline'])
                                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($project['deadline'])->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if(isset($project['assigned_users']) && count($project['assigned_users']) > 0)
                                    <div class="flex items-start gap-2">
                                        <svg class="w-3.5 h-3.5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($project['assigned_users'] as $user)
                                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 whitespace-nowrap">{{ $user['name'] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    @if(isset($project['attachments']) && !empty($project['attachments']) && is_array($project['attachments']))
                                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                            </svg>
                                            <span>{{ count($project['attachments']) }}</span>
                                        </div>
                                    @else
                                        <div></div>
                                    @endif
                                    <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('edit', ['record' => $project['id']]) }}"
                                       class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 px-4">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">No tasks yet</p>
                            <p class="text-xs text-gray-600 mt-1">Drag cards here or click + to add</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- In Progress Column --}}
            <div class="kanban-column-wrapper">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-4 mb-4 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">In Progress</h3>
                                <span class="text-xs text-gray-400">{{ count($inProgressProjects) }} tasks</span>
                            </div>
                        </div>
                        <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('create') }}" 
                           class="w-8 h-8 rounded-lg bg-gray-700 hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="kanban-column space-y-4 px-1" data-status="in_progress">
                    @forelse($inProgressProjects as $project)
                        <div class="kanban-card bg-gray-800/90 backdrop-blur-sm rounded-xl p-5 cursor-grab active:cursor-grabbing shadow-md" data-id="{{ $project['id'] }}">
                            <div class="card-content flex items-start gap-3 mb-4">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white text-sm mb-1.5 leading-tight">
                                        {{ $project['title'] }}
                                    </h4>
                                    @if($project['description'])
                                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">
                                            {{ $project['description'] }}
                                        </p>
                                    @endif
                                </div>
                                @if($project['priority'])
                                    <span class="text-[10px] px-2 py-1 rounded-md font-semibold uppercase tracking-wide
                                        @if($project['priority'] === 'urgent') bg-red-500/20 text-red-300 ring-1 ring-red-500/30 @endif
                                        @if($project['priority'] === 'high') bg-orange-500/20 text-orange-300 ring-1 ring-orange-500/30 @endif
                                        @if($project['priority'] === 'medium') bg-yellow-500/20 text-yellow-300 ring-1 ring-yellow-500/30 @endif
                                        @if($project['priority'] === 'low') bg-green-500/20 text-green-300 ring-1 ring-green-500/30 @endif">
                                        {{ $project['priority'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col gap-3 pt-3 border-t border-gray-700/50">
                                @if($project['deadline'])
                                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($project['deadline'])->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if(isset($project['assigned_users']) && count($project['assigned_users']) > 0)
                                    <div class="flex items-start gap-2">
                                        <svg class="w-3.5 h-3.5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($project['assigned_users'] as $user)
                                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 whitespace-nowrap">{{ $user['name'] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    @if(isset($project['attachments']) && !empty($project['attachments']) && is_array($project['attachments']))
                                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                            </svg>
                                            <span>{{ count($project['attachments']) }}</span>
                                        </div>
                                    @else
                                        <div></div>
                                    @endif
                                    <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('edit', ['record' => $project['id']]) }}"
                                       class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 px-4">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">No active tasks</p>
                            <p class="text-xs text-gray-600 mt-1">Drag cards here to start</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Done Column --}}
            <div class="kanban-column-wrapper">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-4 mb-4 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Done</h3>
                                <span class="text-xs text-gray-400">{{ count($doneProjects) }} tasks</span>
                            </div>
                        </div>
                        <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('create') }}" 
                           class="w-8 h-8 rounded-lg bg-gray-700 hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="kanban-column space-y-4 px-1" data-status="done">
                    @forelse($doneProjects as $project)
                        <div class="kanban-card done bg-gray-800/60 backdrop-blur-sm rounded-xl p-5 cursor-grab active:cursor-grabbing shadow-md opacity-80" data-id="{{ $project['id'] }}">
                            <div class="card-content flex items-start gap-3 mb-4">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white text-sm mb-1.5 leading-tight line-through decoration-green-500/50">
                                        {{ $project['title'] }}
                                    </h4>
                                </div>
                                @if($project['priority'])
                                    <span class="text-[10px] px-2 py-1 rounded-md font-semibold uppercase tracking-wide opacity-50
                                        @if($project['priority'] === 'urgent') bg-red-500/20 text-red-300 ring-1 ring-red-500/30 @endif
                                        @if($project['priority'] === 'high') bg-orange-500/20 text-orange-300 ring-1 ring-orange-500/30 @endif
                                        @if($project['priority'] === 'medium') bg-yellow-500/20 text-yellow-300 ring-1 ring-yellow-500/30 @endif
                                        @if($project['priority'] === 'low') bg-green-500/20 text-green-300 ring-1 ring-green-500/30 @endif">
                                        {{ $project['priority'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col gap-3 pt-3 border-t border-gray-700/50">
                                @if($project['deadline'])
                                    <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($project['deadline'])->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if(isset($project['assigned_users']) && count($project['assigned_users']) > 0)
                                    <div class="flex items-start gap-2">
                                        <svg class="w-3.5 h-3.5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($project['assigned_users'] as $user)
                                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 whitespace-nowrap">{{ $user['name'] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        @if(isset($project['attachments']) && !empty($project['attachments']) && is_array($project['attachments']))
                                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                                </svg>
                                                <span>{{ count($project['attachments']) }}</span>
                                            </div>
                                        @endif
                                        @if($project['completed_at'])
                                            <div class="flex items-center gap-1.5 text-xs text-green-400">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($project['completed_at'])->diffForHumans() }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('edit', ['record' => $project['id']]) }}"
                                       class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 px-4">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">No completed tasks</p>
                            <p class="text-xs text-gray-600 mt-1">Finish tasks to see them here</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pending Column --}}
            <div class="kanban-column-wrapper">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-4 mb-4 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-gray-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Pending</h3>
                                <span class="text-xs text-gray-400">{{ count($pendingProjects) }} tasks</span>
                            </div>
                        </div>
                        <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('create') }}" 
                           class="w-8 h-8 rounded-lg bg-gray-700 hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="kanban-column space-y-4 px-1" data-status="pending">
                    @forelse($pendingProjects as $project)
                        <div class="kanban-card bg-gray-800/90 backdrop-blur-sm rounded-xl p-5 cursor-grab active:cursor-grabbing shadow-md" data-id="{{ $project['id'] }}">
                            <div class="card-content flex items-start gap-3 mb-4">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white text-sm mb-1.5 leading-tight">
                                        {{ $project['title'] }}
                                    </h4>
                                    @if($project['description'])
                                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">
                                            {{ $project['description'] }}
                                        </p>
                                    @endif
                                </div>
                                @if($project['priority'])
                                    <span class="text-[10px] px-2 py-1 rounded-md font-semibold uppercase tracking-wide
                                        @if($project['priority'] === 'urgent') bg-red-500/20 text-red-300 ring-1 ring-red-500/30 @endif
                                        @if($project['priority'] === 'high') bg-orange-500/20 text-orange-300 ring-1 ring-orange-500/30 @endif
                                        @if($project['priority'] === 'medium') bg-yellow-500/20 text-yellow-300 ring-1 ring-yellow-500/30 @endif
                                        @if($project['priority'] === 'low') bg-green-500/20 text-green-300 ring-1 ring-green-500/30 @endif">
                                        {{ $project['priority'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col gap-3 pt-3 border-t border-gray-700/50">
                                @if($project['deadline'])
                                    <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($project['deadline'])->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if(isset($project['assigned_users']) && count($project['assigned_users']) > 0)
                                    <div class="flex items-start gap-2">
                                        <svg class="w-3.5 h-3.5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($project['assigned_users'] as $user)
                                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 whitespace-nowrap">{{ $user['name'] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    @if(isset($project['attachments']) && !empty($project['attachments']) && is_array($project['attachments']))
                                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                            </svg>
                                            <span>{{ count($project['attachments']) }}</span>
                                        </div>
                                    @else
                                        <div></div>
                                    @endif
                                    <a href="{{ \App\Filament\Resources\InternalProjectResource::getUrl('edit', ['record' => $project['id']]) }}"
                                       class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 px-4">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">No tasks yet</p>
                            <p class="text-xs text-gray-600 mt-1">Drag cards here or click + to add</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            setTimeout(() => {
                const columns = document.querySelectorAll('.kanban-column');
                
                // Track if card is being dragged
                let isDragging = false;
                let dragStartTime = 0;
                
                columns.forEach(column => {
                    new Sortable(column, {
                        group: 'kanban',
                        animation: 200,
                        ghostClass: 'sortable-ghost',
                        handle: '.kanban-card',
                        forceFallback: true,
                        onStart: function(evt) {
                            isDragging = true;
                            dragStartTime = Date.now();
                        },
                        onEnd: function(evt) {
                            const projectId = evt.item.dataset.id;
                            const newStatus = evt.to.dataset.status;
                            
                            @this.updateStatus(projectId, newStatus);
                            
                            // Reset drag state after a short delay
                            setTimeout(() => {
                                isDragging = false;
                            }, 100);
                        }
                    });
                });
                
                // Add click handler to all cards
                document.querySelectorAll('.kanban-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        // Don't navigate if clicking on the View link
                        if (e.target.closest('a')) {
                            return;
                        }
                        
                        // Don't navigate if it was a drag (moved for more than 100ms)
                        const timeSinceDragStart = Date.now() - dragStartTime;
                        if (isDragging || timeSinceDragStart < 200) {
                            return;
                        }
                        
                        // Get the project ID and navigate
                        const projectId = this.dataset.id;
                        const editUrl = '{{ url("/nexteam/internal-projects") }}/' + projectId + '/edit';
                        window.location.href = editUrl;
                    });
                    
                    // Add pointer cursor style
                    card.style.cursor = 'pointer';
                });
            }, 500);
        });
    </script>
</x-filament-panels::page>
