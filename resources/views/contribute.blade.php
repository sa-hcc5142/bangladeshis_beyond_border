@extends('layouts.main')

@section('title', 'Contribute - Help Build the Community')

@section('content')
<div class="bg-gray-50 py-8">
    <!-- Header -->
    <div class="gradient-primary mb-8 rounded-2xl">
        <div class="container mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contribute</h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Help fellow Bangladeshi students by contributing data, stories, or code improvements to make this platform better.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Contribution Options -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- GitHub Contribution -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col h-full">
                <div class="flex items-center mb-6">
                    <i class="fab fa-github text-5xl text-gray-800 mr-4"></i>
                    <div>
                        <h2 class="text-2xl font-bold">Contribute via GitHub</h2>
                        <p class="text-gray-600">Open source collaboration</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-6">
                    This project is open source on GitHub. You can contribute bug fixes, new features, data updates, or documentation improvements. All contributions are welcome!
                </p>
                <div class="space-y-4 mb-6 flex-grow">
                    <div class="flex items-start">
                        <i class="fas fa-code text-blue-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Code Contributions</div>
                            <div class="text-sm text-gray-600">Fix bugs, add features, improve UI/UX</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-database text-green-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Data Updates</div>
                            <div class="text-sm text-gray-600">Update university rankings, add new institutions</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-book text-purple-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Documentation</div>
                            <div class="text-sm text-gray-600">Improve guides, fix typos, add examples</div>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 mt-auto">
                    <a href="#" onclick="openModal('contributionGuideModal'); return false;" 
                       class="flex-1 text-center px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-lg smooth-transition">
                        <i class="fas fa-info-circle mr-2"></i>
                        View Guide
                    </a>
                    <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border" target="_blank"
                       class="flex-1 text-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg smooth-transition">
                        <i class="fab fa-github mr-2"></i>
                        GitHub Repo
                    </a>
                </div>
            </div>

            <!-- Share Your Story -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col h-full">
                <div class="flex items-center mb-6">
                    <i class="fas fa-pencil-alt text-5xl text-blue-600 mr-4"></i>
                    <div>
                        <h2 class="text-2xl font-bold">Share Your Story</h2>
                        <p class="text-gray-600">Inspire future students</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-6">
                    Your journey matters. Share your application experience, scholarship tips, campus life insights, or cultural adjustment stories to help students preparing for their own adventure.
                </p>
                <div class="space-y-4 mb-6 flex-grow">
                    <div class="flex items-start">
                        <i class="fas fa-graduation-cap text-blue-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Application Journey</div>
                            <div class="text-sm text-gray-600">Tips, timeline, mistakes to avoid</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-trophy text-yellow-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Scholarship Success</div>
                            <div class="text-sm text-gray-600">How you secured funding, essay samples</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-globe text-green-600 mr-3 mt-1"></i>
                        <div>
                            <div class="font-semibold">Life Abroad</div>
                            <div class="text-sm text-gray-600">Cultural insights, survival tips, community</div>
                        </div>
                    </div>
                </div>
                <a href="mailto:contribute@bangladeshisbeyondborder.com?subject=Blog Post Submission" 
                   class="block text-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg smooth-transition mt-auto">
                    <i class="fas fa-envelope mr-2"></i>
                    Submit Your Story
                </a>
            </div>
        </div>

        <!-- How to Contribute Section -->
        <div class="rounded-xl shadow-lg p-8 mb-8" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);">
            <h2 class="text-3xl font-bold mb-6" style="color: #e6f1f3;">How You Can Help</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 rounded-xl" style="background: rgba(15, 42, 48, 0.8); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <i class="fas fa-university text-4xl text-blue-400 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2" style="color: #e6f1f3;">Add University Data</h3>
                    <p class="text-sm" style="color: #99a9ad;">
                        Know a university missing from our database? Submit details about programs, scholarships, and admission requirements.
                    </p>
                </div>
                <div class="text-center p-6 rounded-xl" style="background: rgba(15, 42, 48, 0.8); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <i class="fas fa-map-marked-alt text-4xl text-green-400 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2" style="color: #e6f1f3;">Improve Country Guides</h3>
                    <p class="text-sm" style="color: #99a9ad;">
                        Living abroad? Share updated living costs, visa processes, and local tips for students in your country.
                    </p>
                </div>
                <div class="text-center p-6 rounded-xl" style="background: rgba(15, 42, 48, 0.8); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <i class="fas fa-users text-4xl text-purple-400 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2" style="color: #e6f1f3;">Connect Students</h3>
                    <p class="text-sm" style="color: #99a9ad;">
                        Help build the community by sharing resources, answering questions, and mentoring applicants.
                    </p>
                </div>
            </div>
        </div>

        <!-- Community Stats -->
        <div class="gradient-primary rounded-xl shadow-lg p-8 text-white text-center mb-8">
            <h2 class="text-3xl font-bold mb-4">Community Impact</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <div class="text-4xl font-bold">600+</div>
                    <div class="text-white/80">Universities Listed</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">56</div>
                    <div class="text-white/80">Subject Areas</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">25+</div>
                    <div class="text-white/80">Countries Covered</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">Open</div>
                    <div class="text-white/80">Source Project</div>
                </div>
            </div>
        </div>

        <!-- Guidelines -->
        <div class="rounded-xl p-6" style="background: rgba(15, 42, 48, 0.8); border: 2px solid rgba(56, 189, 248, 0.3);">
            <div class="flex items-start space-x-4">
                <i class="fas fa-info-circle text-3xl text-blue-400 mt-1"></i>
                <div>
                    <h3 class="text-xl font-bold mb-2" style="color: #e6f1f3;">Contribution Guidelines</h3>
                    <ul class="space-y-2" style="color: #99a9ad;">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Ensure information is accurate and up-to-date</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Cite sources when adding data or statistics</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Follow the existing code style and formatting</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Be respectful and constructive in all interactions</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Test your changes before submitting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contribution Guide Modal -->
<div id="contributionGuideModal" class="modal">
    <div class="modal-overlay" onclick="closeModal('contributionGuideModal')"></div>
    <div class="modal-content max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6 sticky top-0 bg-white dark:bg-gray-800 pb-4 border-b z-10">
            <h2 class="text-3xl font-bold">GitHub Contribution Guide</h2>
            <button onclick="closeModal('contributionGuideModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="prose max-w-none dark:prose-invert">
            <h3 class="text-xl font-bold mb-3">Getting Started</h3>
            <ol class="list-decimal list-inside space-y-2 mb-6">
                <li><strong>Fork the repository</strong> - Create your own copy of the project</li>
                <li><strong>Clone your fork</strong> - Download it to your local machine</li>
                <li><strong>Create a branch</strong> - Make changes in a separate branch</li>
                <li><strong>Make your changes</strong> - Add features, fix bugs, or update data</li>
                <li><strong>Test thoroughly</strong> - Ensure everything works correctly</li>
                <li><strong>Commit and push</strong> - Save your changes to your fork</li>
                <li><strong>Create a Pull Request</strong> - Submit your changes for review</li>
            </ol>

            <h3 class="text-xl font-bold mb-3">Code Example</h3>
            <div class="bg-gray-900 text-gray-100 p-4 rounded-lg mb-6 overflow-x-auto">
                <pre class="text-sm"><code># Fork and clone the repository
git clone https://github.com/sa-hcc5142/bangladeshis_beyond_border.git
cd bangladeshis-beyond-border

# Create a new branch
git checkout -b feature/add-new-university

# Make your changes, then commit
git add .
git commit -m "Add Harvard University data and rankings"

# Push to your fork
git push origin feature/add-new-university

# Create Pull Request on GitHub</code></pre>
            </div>

            <h3 class="text-xl font-bold mb-3">What to Contribute</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h4 class="font-bold mb-2">🐛 Bug Fixes</h4>
                    <p class="text-sm text-gray-700">Found an issue? Fix it and submit a PR with a clear description.</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <h4 class="font-bold mb-2">✨ New Features</h4>
                    <p class="text-sm text-gray-700">Add useful functionality that helps students make decisions.</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h4 class="font-bold mb-2">📊 Data Updates</h4>
                    <p class="text-sm text-gray-700">Keep rankings current, add new universities, update costs.</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <h4 class="font-bold mb-2">📖 Documentation</h4>
                    <p class="text-sm text-gray-700">Improve README, add code comments, write tutorials.</p>
                </div>
            </div>

            <h3 class="text-xl font-bold mb-3">Need Help?</h3>
            <p class="text-gray-700">
                Check out the <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border/issues" target="_blank" class="text-blue-600 hover:underline">Issues page</a> 
                for tasks labeled "good first issue" or "help wanted". Join our 
                <a href="#" class="text-blue-600 hover:underline">Discord community</a> to ask questions!
            </p>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <button onclick="closeModal('contributionGuideModal')" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg smooth-transition">
                Close
            </button>
            <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border" target="_blank" 
               class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg smooth-transition">
                Go to GitHub
            </a>
        </div>
    </div>
</div>
@endsection
