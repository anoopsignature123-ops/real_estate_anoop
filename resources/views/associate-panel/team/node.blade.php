{{-- resources/views/associate-panel/team/node.blade.php --}}

<div class="org-level">

    <div class="node-wrapper">

        {{-- Tooltip --}}
        <div class="associate-tooltip shadow-lg">

            <div class="tooltip-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="tooltip-avatar">

                        {{ strtoupper(substr($associate->associate_name, 0, 1)) }}

                    </div>

                    <div>

                        <div class="tooltip-title">

                            {{ $associate->associate_name }}

                        </div>

                        <div class="tooltip-subtitle">

                            {{ $associate->associate_id }}

                        </div>

                    </div>

                </div>

            </div>

            <div class="tooltip-body">

                <div class="tooltip-item">

                    <span>Sponsor ID</span>

                    <strong>{{ $associate->sponsor_id ?? '-' }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Under Place</span>

                    <strong>{{ $associate->under_place_id ?? '-' }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Direct Team</span>

                    <strong>{{ $associate->direct_count }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Total Downline</span>

                    <strong>{{ $associate->downline_count }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Level</span>

                    <strong>{{ $associate->level }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Mobile</span>

                    <strong>{{ $associate->mobile_number ?? '-' }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Rank</span>

                    <strong>{{ $associate->rank?->designation ?? '-' }}</strong>

                </div>

                <div class="tooltip-item">

                    <span>Joining</span>

                    <strong>{{ $associate->created_at?->format('d M Y') }}</strong>

                </div>

            </div>

        </div>

        {{-- Main Card --}}
        <div class="associate-card">

            <div class="associate-top"></div>

            <div class="associate-avatar">

                {{ strtoupper(substr($associate->associate_name, 0, 1)) }}

            </div>

            <div class="associate-content">

                <div class="associate-id">

                    {{ $associate->associate_id }}

                </div>

                <div class="associate-name">

                    {{ $associate->associate_name }}

                </div>

                <div class="associate-rank">

                    {{ $associate->rank?->designation ?? 'Associate' }}

                </div>

            </div>

        </div>

    </div>

    {{-- Child Nodes --}}
    @if ($associate->children->count())

        <div class="vertical-line"></div>

        <div class="children-wrapper">

            @foreach ($associate->children as $child)
                <div class="child-node">

                    @include('associate-panel.team.node', [
                        'associate' => $child,
                    ])

                </div>
            @endforeach

        </div>

    @endif

</div>
