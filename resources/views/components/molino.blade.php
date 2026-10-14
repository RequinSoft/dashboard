@props(['running', 'svgId'])

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 420 320" width="350" height="350"
    class="mill-illustration {{ $running ? 'text-success' : 'text-danger' }}"
    style="max-width: 100%; height: auto;"
    role="img" aria-label="Molino de bolas {{ $running ? 'en marcha' : 'detenido' }}">
    <title>Molino de bolas {{ $running ? 'en marcha' : 'detenido' }}</title>
    <defs>
        <linearGradient id="{{ $svgId }}-steel" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#475569" />
            <stop offset=".3" stop-color="#cbd5e1" />
            <stop offset=".5" stop-color="#94a3b8" />
            <stop offset="1" stop-color="#334155" />
        </linearGradient>
        <radialGradient id="{{ $svgId }}-face">
            <stop offset="0" stop-color="#cbd5e1" />
            <stop offset=".7" stop-color="#94a3b8" />
            <stop offset="1" stop-color="#475569" />
        </radialGradient>
    </defs>
    <style>
        .mill-illustration .mill-drum {
            animation: mill-drum-turn 6s linear infinite;
        }
        @keyframes mill-drum-turn {
            to { transform: rotate(360deg); }
        }
        @media (prefers-reduced-motion: reduce) {
            .mill-illustration .mill-drum { animation: none; }
        }
    </style>

    <ellipse cx="220" cy="281" rx="177" ry="15" fill="#0f172a" opacity=".12" />
    <path d="M38 260h334l24 20H62z" fill="#64748b" stroke="#334155" stroke-width="3" />
    <path d="M62 280h334v10H62z" fill="#334155" />

    {{-- Stationary trunnion bearings and feed chute. --}}
    <path d="M75 213h48l15 48H62zM235 241h53l15 27h-83z"
        fill="#94a3b8" stroke="#334155" stroke-width="3" />
    <path d="M37 89h48l24 34v49H84v-39L60 113H37z"
        fill="#cbd5e1" stroke="#475569" stroke-width="3" />
    <path d="M90 154h39v43H90z" fill="#64748b" stroke="#334155" stroke-width="3" />

    {{-- Cylindrical shell in perspective, with reinforcement bands. --}}
    <ellipse cx="137" cy="133" rx="64" ry="94" fill="#475569" stroke="#334155" stroke-width="4" />
    <path d="M137 39 257 78a64 94 0 0 1 0 188L137 227a64 94 0 0 0 0-188z"
        fill="url(#{{ $svgId }}-steel)" stroke="#334155" stroke-width="4" />
    <g fill="none" stroke="#475569" stroke-width="5">
        <path d="M163 48a64 94 0 0 1 0 188" />
        <path d="M224 68a64 94 0 0 1 0 188" />
    </g>
    <g stroke="#e2e8f0" stroke-width="2" opacity=".6">
        <path d="m159 59 111 36M188 90l112 36M198 139l119 39M185 192l111 36" />
    </g>

    {{-- Project the rotating end plate onto the drum's elliptical face. --}}
    <g transform="translate(257 172) scale(.68 1)">
        <g class="mill-drum" style="animation-play-state: {{ $running ? 'running' : 'paused' }};">
            <circle r="101" fill="#a16207" stroke="#713f12" stroke-width="4" />
            <circle r="99" fill="none" stroke="#facc15" stroke-width="10" stroke-dasharray="5 5" />
            <circle r="89" fill="url(#{{ $svgId }}-face)" stroke="#334155" stroke-width="5" />
            <circle r="76" fill="none" stroke="currentColor" stroke-width="8" />
            <g fill="#64748b" stroke="#334155" stroke-width="2">
                @foreach (range(0, 7) as $rib)
                    <path d="M-7-65h14l-3 42H-4z" transform="rotate({{ $rib * 45 }})" />
                @endforeach
            </g>
            <g fill="#e2e8f0" stroke="#334155" stroke-width="2">
                @foreach (range(0, 15) as $bolt)
                    <circle cy="-84" r="3" transform="rotate({{ $bolt * 22.5 }})" />
                @endforeach
            </g>
            <circle r="29" fill="#475569" stroke="#1e293b" stroke-width="4" />
            <circle r="20" fill="#94a3b8" stroke="#cbd5e1" stroke-width="3" />
            <path d="M-4-19h8v12h-8z" fill="#334155" />
        </g>
    </g>

    <path d="m258 151 38 12v39l-38-11z" fill="#64748b" stroke="#334155" stroke-width="3" />
    <ellipse cx="296" cy="183" rx="14" ry="20" fill="#334155" stroke="#94a3b8" stroke-width="4" />
    <path d="M280 201h32v43h-32z" fill="#94a3b8" stroke="#334155" stroke-width="3" />
    <path d="M278 244h37v13h-37z" fill="#475569" />

    {{-- Fixed drive motor and pinion assembly. --}}
    <path d="M319 226h57v36h-57z" fill="#475569" stroke="#1e293b" stroke-width="3" />
    <path d="m319 226 12-12h57l-12 12z" fill="#94a3b8" stroke="#334155" stroke-width="3" />
    <path d="m376 226 12-12v35l-12 13z" fill="#334155" />
    <g stroke="#94a3b8" stroke-width="3">
        <path d="M328 232v23M337 232v23M346 232v23M355 232v23M364 232v23" />
    </g>
    <path d="M306 240h13" stroke="#334155" stroke-width="8" />
    <circle cx="300" cy="240" r="12" fill="#a16207" stroke="#713f12" stroke-width="3" />
    <circle cx="300" cy="240" r="9" fill="none" stroke="#facc15" stroke-width="4" stroke-dasharray="3 3" />
    <path d="M327 261v8h45v-8" fill="#64748b" stroke="#334155" stroke-width="3" />
    <circle cx="352" cy="219" r="5" fill="currentColor" stroke="#1e293b" stroke-width="2" />
</svg>
