<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rankings by Subject</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .subject-card {
            transition: all 0.3s ease;
        }
        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold">QS World University Rankings by Subject</h1>
            <p class="mt-2 text-purple-100">Explore top universities by academic discipline</p>
            <div class="mt-4 flex space-x-4">
                <a href="{{ route('rankings.index') }}" class="px-4 py-2 bg-white bg-opacity-20 rounded hover:bg-opacity-30 transition">
                    Overall Rankings
                </a>
                <a href="{{ route('subjects.browse') }}" class="px-4 py-2 bg-white text-purple-600 rounded hover:bg-gray-100 transition">
                    Rankings by Subject
                </a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Select a Subject</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover how universities perform in specific academic fields. Click on any subject to see the detailed rankings.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($subjects as $subject)
                <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block">
                    <div class="bg-white rounded-lg shadow-md p-6 h-full">
                        <div class="text-center">
                            <div class="text-5xl mb-4">{{ $subject->icon ?? '📚' }}</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $subject->name }}</h3>
                            @if($subject->description)
                                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($subject->description, 100) }}</p>
                            @endif
                            <div class="inline-flex items-center text-purple-600 font-semibold">
                                View Rankings
                                <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Popular Subjects Highlight -->
        <div class="mt-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 text-white">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="text-4xl font-bold">{{ $subjects->count() }}</div>
                    <div class="mt-2">Academic Subjects</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">1500+</div>
                    <div class="mt-2">Universities Ranked</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">100+</div>
                    <div class="mt-2">Countries</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
