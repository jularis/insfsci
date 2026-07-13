<div class="w-full h-full flex items-center justify-center p-6 bg-gradient-to-br from-slate-950 to-slate-900">
    <svg class="w-full h-full max-w-2xl" viewBox="0 0 800 480" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="gradOrange" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#f97316;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
            </linearGradient>
            <linearGradient id="gradRed" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#dc2626;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#b91c1c;stop-opacity:1" />
            </linearGradient>
            <linearGradient id="gradBlue" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#0ea5e9;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0284c7;stop-opacity:1" />
            </linearGradient>
            <filter id="shadow" x="-50%" y="-50%" width="200%" height="200%">
                <feDropShadow dx="0" dy="4" stdDeviation="3" flood-opacity="0.3"/>
            </filter>
        </defs>

        <!-- Titre -->
        <text x="400" y="40" font-size="32" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Parcours de Formation
        </text>
        <text x="400" y="65" font-size="14" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="2">
            TROIS PILIERS DE L'EXCELLENCE
        </text>

        <!-- Ligne de connexion centrale -->
        <line x1="100" y1="240" x2="700" y2="240" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5,5" opacity="0.5"/>

        <!-- PILIER 1: Formation Théorique -->
        <g filter="url(#shadow)">
            <!-- Cercle -->
            <circle cx="150" cy="240" r="60" fill="url(#gradOrange)"/>
            <!-- Icône (livre) -->
            <rect x="135" y="225" width="30" height="25" fill="#ffffff" rx="3"/>
            <line x1="150" y1="225" x2="150" y2="250" stroke="#f97316" stroke-width="2"/>
            <line x1="140" y1="230" x2="160" y2="230" stroke="#f97316" stroke-width="1.5"/>
            <line x1="140" y1="237" x2="160" y2="237" stroke="#f97316" stroke-width="1.5"/>
            <line x1="140" y1="244" x2="160" y2="244" stroke="#f97316" stroke-width="1.5"/>
        </g>

        <!-- Texte Pilier 1 -->
        <text x="150" y="330" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Formation
        </text>
        <text x="150" y="350" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Théorique
        </text>
        <text x="150" y="380" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            Enseignement
        </text>
        <text x="150" y="395" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            académique
        </text>

        <!-- PILIER 2: Formation Pratique -->
        <g filter="url(#shadow)">
            <!-- Cercle central (plus grand) -->
            <circle cx="400" cy="240" r="70" fill="url(#gradRed)"/>
            <!-- Icône (stage/terrain) -->
            <rect x="380" y="220" width="40" height="40" fill="#ffffff" rx="2"/>
            <circle cx="395" cy="230" r="3" fill="#dc2626"/>
            <circle cx="410" cy="235" r="2" fill="#dc2626"/>
            <circle cx="390" cy="245" r="2.5" fill="#dc2626"/>
            <line x1="385" y1="255" x2="415" y2="255" stroke="#dc2626" stroke-width="2"/>
        </g>

        <!-- Texte Pilier 2 -->
        <text x="400" y="330" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Formation
        </text>
        <text x="400" y="350" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Pratique
        </text>
        <text x="400" y="380" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            Stages &amp;
        </text>
        <text x="400" y="395" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            terrain professionnel
        </text>

        <!-- PILIER 3: Recherche & Suivi -->
        <g filter="url(#shadow)">
            <!-- Cercle -->
            <circle cx="650" cy="240" r="60" fill="url(#gradBlue)"/>
            <!-- Icône (graphique) -->
            <g>
                <rect x="635" y="245" width="6" height="15" fill="#ffffff"/>
                <rect x="645" y="240" width="6" height="20" fill="#ffffff"/>
                <rect x="655" y="235" width="6" height="25" fill="#ffffff"/>
            </g>
            <line x1="635" y1="260" x2="661" y2="260" stroke="#ffffff" stroke-width="2"/>
        </g>

        <!-- Texte Pilier 3 -->
        <text x="650" y="330" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Recherche &amp;
        </text>
        <text x="650" y="350" font-size="16" font-weight="bold" fill="#ffffff" text-anchor="middle" font-family="sans-serif">
            Suivi
        </text>
        <text x="650" y="380" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            Études &amp;
        </text>
        <text x="650" y="395" font-size="11" fill="#cbd5e1" text-anchor="middle" font-family="sans-serif" letter-spacing="0.5">
            évaluation
        </text>

        <!-- Flèches de connexion -->
        <defs>
            <marker id="arrowhead" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                <polygon points="0 0, 10 3, 0 6" fill="#94a3b8" opacity="0.6"/>
            </marker>
        </defs>

        <!-- Flèche 1 vers 2 -->
        <path d="M 210 240 L 330 240" stroke="#94a3b8" stroke-width="2" fill="none" marker-end="url(#arrowhead)" opacity="0.6"/>

        <!-- Flèche 2 vers 3 -->
        <path d="M 470 240 L 590 240" stroke="#94a3b8" stroke-width="2" fill="none" marker-end="url(#arrowhead)" opacity="0.6"/>

        <!-- Badge INSFS en bas -->
        <rect x="300" y="430" width="200" height="35" fill="#1e293b" stroke="#64748b" stroke-width="1" rx="4" opacity="0.8"/>
        <text x="400" y="452" font-size="12" font-weight="bold" fill="#f97316" text-anchor="middle" font-family="sans-serif" letter-spacing="1">
            INSFS - INSTITUT SUPÉRIEUR
        </text>
    </svg>
</div>
