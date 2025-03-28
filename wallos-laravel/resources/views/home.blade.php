@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        <!-- Space illustration with astronaut -->
        <div class="mb-8 relative w-full max-w-lg">
            <div class="space-scene">
                <!-- Planets and stars are created with CSS -->
                <div class="astronaut">
                    <!-- Inline SVG for the astronaut -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="300" height="300">
                        <!-- Astronaut with clipboard -->
                        <g id="astronaut">
                            <!-- Head/Helmet -->
                            <circle cx="250" cy="180" r="70" fill="#2d3748" />
                            <circle cx="250" cy="180" r="65" fill="white" stroke="#2d3748" stroke-width="2" />
                            
                            <!-- Visor -->
                            <path d="M220,180 a30,30 0 0,1 60,0 a30,30 0 0,1 -60,0" fill="#2c5282" />
                            
                            <!-- Body -->
                            <rect x="180" y="250" width="140" height="180" rx="70" fill="white" stroke="#2d3748" stroke-width="2" />
                            
                            <!-- Arms -->
                            <rect x="150" y="270" width="30" height="100" rx="15" fill="white" stroke="#2d3748" stroke-width="2" transform="rotate(-20, 150, 270)" />
                            <rect x="320" y="270" width="30" height="100" rx="15" fill="white" stroke="#2d3748" stroke-width="2" transform="rotate(20, 320, 270)" />
                            
                            <!-- Clipboard -->
                            <rect x="200" y="300" width="100" height="120" rx="10" fill="#3182ce" />
                            <rect x="210" y="310" width="80" height="100" rx="5" fill="white" />
                            
                            <!-- Clipboard details -->
                            <rect x="220" y="330" width="60" height="10" rx="5" fill="#e2e8f0" />
                            <rect x="220" y="350" width="60" height="10" rx="5" fill="#e2e8f0" />
                            <rect x="220" y="370" width="60" height="10" rx="5" fill="#e2e8f0" />
                            <rect x="220" y="390" width="30" height="10" rx="5" fill="#e2e8f0" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Message -->
        <h2 class="text-2xl font-semibold text-center mb-6">You don't have any subscriptions yet</h2>
        
        <!-- Add subscription button -->
        <a href="{{ route('subscriptions.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add first subscription
        </a>
    </div>
</div>

<style>
    .space-scene {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .space-scene::before {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background-color: #CBD5E0;
        border-radius: 50%;
        top: 50px;
        left: 20%;
        z-index: -1;
    }
    
    .space-scene::after {
        content: '';
        position: absolute;
        width: 120px;
        height: 20px;
        border: 1px solid #CBD5E0;
        border-radius: 50%;
        top: 90px;
        left: calc(20% - 10px);
        transform: rotate(15deg);
        z-index: -1;
    }
    
    .astronaut {
        position: relative;
        z-index: 10;
    }
    
    .astronaut::before {
        content: '';
        position: absolute;
        width: 80px;
        height: 80px;
        background-color: #E2E8F0;
        border-radius: 50%;
        top: 40px;
        right: -100px;
        z-index: -1;
    }
    
    .astronaut::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: #E2E8F0;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        top: 30px;
        right: -50px;
        z-index: -1;
    }
    
    .space-scene::before,
    .space-scene::after,
    .astronaut::before,
    .astronaut::after {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0px);
        }
    }
</style>
@endsection