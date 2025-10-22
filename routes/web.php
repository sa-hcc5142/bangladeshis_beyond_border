<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityRankingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('universities', \App\Http\Controllers\Admin\UniversityController::class);
    
    // Comment Management Routes
    Route::get('/comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::post('/comments/{comment}/approve', [\App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('comments.approve');
    Route::post('/comments/{comment}/reject', [\App\Http\Controllers\Admin\CommentController::class, 'reject'])->name('comments.reject');
    Route::post('/comments/{comment}/answer', [\App\Http\Controllers\Admin\CommentController::class, 'answer'])->name('comments.answer');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Quick approve route (invokable controller)
    Route::post('/comments/{comment}/quick-approve', \App\Http\Controllers\Admin\ApproveCommentController::class)->name('comments.quick-approve');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Comment Routes (for authenticated users)
Route::middleware(['auth', 'banned'])->group(function () {
    Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::get('/my-comments', [\App\Http\Controllers\CommentController::class, 'myComments'])->name('comments.my');
});

// Password Reset Routes
Route::get('/password/reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [\App\Http\Controllers\Auth\PasswordResetController::class, 'update'])->name('password.update');

// Public Routes - No Authentication Required
Route::group([], function () {
    // University Rankings Routes
    Route::get('/rankings', [UniversityRankingController::class, 'index'])->name('rankings.index');
    Route::get('/rankings/subjects', [UniversityRankingController::class, 'bySubject'])->name('subjects.browse');
    Route::get('/rankings/subjects/{subject}', [UniversityRankingController::class, 'bySubject'])->name('rankings.by-subject');
    Route::get('/rankings/university/{slug}', [UniversityRankingController::class, 'show'])->name('rankings.show');
});

// University Deep-Dive Routes
Route::get('/university/{slug}/alumni', [UniversityRankingController::class, 'alumni'])->name('university.alumni');
Route::get('/university/{slug}/research', [UniversityRankingController::class, 'research'])->name('university.research');
Route::get('/university/{slug}/residential', [UniversityRankingController::class, 'residential'])->name('university.residential');
Route::get('/university/{slug}/jobs', [UniversityRankingController::class, 'jobs'])->name('university.jobs');

// Country Guides Routes
Route::get('/countries', function () {
    return view('countries.index');
})->name('countries.index');

Route::get('/countries/{slug}', function ($slug) {
    // Define country data for each of the 6 countries
    $countries = [
        'united-states' => [
            'name' => 'United States',
            'tagline' => 'Study in the Land of Opportunity',
            'hero_image' => 'https://images.unsplash.com/photo-1485738422979-f5c462d49f74?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '150+',
                'monthly_cost' => '$1,500',
                'students' => '1M+',
                'work_hours' => '20-40hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => '$20,000 - $60,000/year (varies by institution)',
                    'housing' => '$500 - $1,500/month (on/off campus)',
                    'food' => '$300 - $600/month',
                    'transport' => '$50 - $150/month (public transit)',
                    'insurance' => '$1,500 - $2,500/year (mandatory)',
                    'tip' => 'Public universities in smaller cities offer lower tuition and living costs. Community colleges provide affordable pathway to 4-year degrees. Look for on-campus jobs (up to 20 hrs/week) and assistantships.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'English',
                    'tests' => 'TOEFL (80+), IELTS (6.5+), Duolingo (105+)',
                    'esl' => 'Available at most universities',
                    'admission' => 'Yes, many institutions offer',
                    'support' => 'Writing centers and tutoring free',
                    'tip' => 'Most universities have International Student Support offices offering free conversation partners, writing workshops, and cultural orientation programs. Many cities have ESL community centers for additional practice.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Interactive, discussion-based, critical thinking',
                    'participation' => 'Expected in class (counted in grade)',
                    'diversity' => 'Very multicultural campus environments',
                    'organizations' => '100-500+ clubs per university',
                    'campus_life' => 'Active sports, events, Greek life',
                    'tip' => 'American universities emphasize speaking up in class, networking, and extracurricular involvement. Professors expect you to challenge ideas respectfully. Office hours are crucial for building relationships. Join cultural organizations to find community.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Meal plans required for freshmen',
                    'halal' => 'Available in most major universities',
                    'grocery' => 'Easy access in cities',
                    'eating_out' => '$10-20 per meal average',
                    'cooking' => 'Apartments have full kitchens',
                    'tip' => 'Most campus dining halls offer vegetarian and halal options. Find ethnic grocery stores for ingredients from home. Meal prep saves significant money. Many universities have halal certification for dining facilities. Student discounts available at many restaurants.'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Active at most campuses',
                    'prayer' => 'Many universities provide',
                    'centers' => 'Asian, African, Middle Eastern',
                    'mentorship' => 'Peer and faculty mentors',
                    'iso' => 'Dedicated support staff',
                    'tip' => 'Connect with Bangladeshi Student Associations early. They organize cultural events, help with settling in, and provide homesickness support. Many cities have Bangladeshi communities offering home-cooked meals and cultural connection. Build diverse friendships while maintaining cultural ties.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1569098644584-210bcd375b59?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'F-1 Student Visa',
                    'processing' => '2-4 weeks after interview',
                    'documents' => 'I-20, financial proof, passport',
                    'interview' => 'At US Embassy in Dhaka',
                    'work' => 'CPT, OPT (12-36 months)',
                    'tip' => 'Apply for visa 3 months before program start. Demonstrate strong ties to Bangladesh and clear intent to return. STEM graduates get 3-year OPT extension. H-1B visa sponsorship possible after graduation. Maintain full-time enrollment (12+ credits) to keep visa status.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'SAT (1200+) or ACT (24+)',
                    'grad' => 'GRE (310+), GMAT (650+) for business',
                    'english' => 'TOEFL (80-100), IELTS (6.5-7.5)',
                    'optional' => 'Some schools waive SAT/ACT',
                    'prep' => '3-6 months recommended',
                    'tip' => 'Khan Academy offers free SAT prep. Magoosh and Manhattan Prep are popular GRE resources. Take official practice tests to gauge progress. Many schools went test-optional post-COVID. Strong GPA and essays can offset lower test scores. Subject GRE helpful for top PhD programs.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1534088568595-a066f410bcda?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Tropical to Arctic climates',
                    'northeast' => 'Cold winters (-10°C), hot summers',
                    'south' => 'Hot, humid, mild winters',
                    'west' => 'Mediterranean, mild year-round',
                    'midwest' => 'Four distinct seasons, snowy winters',
                    'tip' => 'Invest in a good winter coat for northern schools. Southern California and Florida have weather similar to Bangladesh. Midwest winters require boots, gloves, and layers. Dorm heating is excellent. Most buildings are connected or have tunnels in cold climates.'
                ]
            ]
        ],
        'united-kingdom' => [
            'name' => 'United Kingdom',
            'tagline' => 'Study at World-Class Historic Universities',
            'hero_image' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '130+',
                'monthly_cost' => '£1,200',
                'students' => '600K+',
                'work_hours' => '20hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1580674285054-bed31e145f59?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => '£10,000 - £38,000/year (varies by program)',
                    'housing' => '£400 - £1,000/month (halls/private)',
                    'food' => '£200 - £400/month',
                    'transport' => '£60 - £150/month (student discounts)',
                    'insurance' => 'NHS surcharge £470/year',
                    'tip' => 'London is 30-40% more expensive than other cities. Universities outside London like Manchester, Birmingham offer excellent education at lower costs. Part-time work helps cover living expenses. Many scholarships cover full tuition.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'English (British accent)',
                    'tests' => 'IELTS (6.0-7.0), TOEFL (80-100), PTE (59-70)',
                    'esl' => 'Pre-sessional courses available',
                    'admission' => 'Some universities offer conditional',
                    'support' => 'Free academic writing support',
                    'tip' => 'British English differs from American in spelling and terminology. Universities provide free English support throughout your studies. Student unions run conversation clubs. IELTS is preferred over TOEFL for UK applications.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1513581166391-887a96ddeafd?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Independent study, tutorials, lectures',
                    'participation' => 'Smaller seminars encourage discussion',
                    'diversity' => 'Highly international student body',
                    'organizations' => '200+ societies per university',
                    'campus_life' => 'Pub culture, formal dinners, sports',
                    'tip' => 'UK education emphasizes independent research and critical analysis. Tutorial system at Oxford/Cambridge is unique. Join societies early for social life. Formal balls and traditions are part of the experience. Pub culture is central to socializing.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Catered halls available',
                    'halal' => 'Easy access in most cities',
                    'grocery' => 'Tesco, Sainsbury\'s, Asian stores',
                    'eating_out' => '£8-15 per meal',
                    'cooking' => 'Shared kitchen in student accommodation',
                    'tip' => 'Halal food readily available in UK cities with large Muslim populations. Aldi and Lidl are budget-friendly supermarkets. Student discount apps like UNiDAYS save money. Cooking is common as meal plans aren\'t typical. South Asian restaurants abundant.'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Islamic Societies active nationwide',
                    'prayer' => 'Prayer rooms in most universities',
                    'centers' => 'Large Bangladeshi communities',
                    'mentorship' => 'Buddy schemes and peer mentors',
                    'iso' => 'International student support teams',
                    'tip' => 'UK has large Bangladeshi diaspora, especially in London, Birmingham, Manchester. Islamic Societies are well-established and active. Most universities accommodate religious needs. Weekend trips to European cities are affordable and easy.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1473186578172-c141e6798cf4?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'Student Route (Tier 4) Visa',
                    'processing' => '3 weeks typically',
                    'documents' => 'CAS, financial proof, TB test',
                    'interview' => 'May be required for some applicants',
                    'work' => 'Graduate Route: 2-year post-study work',
                    'tip' => 'Apply 3 months before course start. Financial requirement: tuition + £1,334/month (London) or £1,023/month (outside). TB test mandatory for Bangladesh. Graduate Route visa allows 2 years of work. Bring original documents to appointment.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'A-Levels preferred (or equivalent)',
                    'grad' => 'No GRE typically required',
                    'english' => 'IELTS (6.0-7.5), TOEFL (80-100)',
                    'optional' => 'GMAT for MBA programs',
                    'prep' => '2-3 months for IELTS',
                    'tip' => 'UK doesn\'t require SAT/ACT for undergrad. IELTS is preferred English test. Some universities accept Duolingo. Master\'s programs focus more on academic transcript than test scores. Personal statement is crucial.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1487956382158-bb926046304a?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Temperate maritime climate',
                    'year_round' => 'Cool, rainy, unpredictable',
                    'winter' => 'Mild (0-8°C), rarely snows',
                    'summer' => 'Cool (15-25°C), pleasant',
                    'rain' => 'Frequent light rain throughout year',
                    'tip' => 'Always carry an umbrella and waterproof jacket. Weather changes quickly. Heating bills can be high in winter. Summer is the best season. Grey skies are common but cities have indoor entertainment. Layering is key to staying comfortable.'
                ]
            ]
        ],
        'canada' => [
            'name' => 'Canada',
            'tagline' => 'Quality Education with Immigration Pathways',
            'hero_image' => 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '90+',
                'monthly_cost' => 'CAD 1,200',
                'students' => '700K+',
                'work_hours' => '20hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1517935706615-2717063c2225?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => 'CAD 15,000 - 35,000/year',
                    'housing' => 'CAD 600 - 1,500/month',
                    'food' => 'CAD 300 - 500/month',
                    'transport' => 'CAD 80 - 150/month',
                    'insurance' => 'CAD 600 - 900/year',
                    'tip' => 'Cities like Montreal, Winnipeg are more affordable than Toronto/Vancouver. Quebec offers lowest tuition for French-program students. Co-op programs help earn while studying. Provincial nominee programs offer PR pathways.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1491841573634-28140fc7ced7?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'English and French (bilingual)',
                    'tests' => 'IELTS (6.5+), TOEFL (90+), CAEL, PTE',
                    'esl' => 'Pathway programs available',
                    'admission' => 'Conditional admission offered',
                    'support' => 'ESL support throughout studies',
                    'tip' => 'Quebec universities teach in French but many offer English programs. Learning French helps in Quebec and increases job prospects. Canadian English is similar to American. Universities provide excellent language support.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1530099486328-e021101a494a?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Balanced lectures and discussions',
                    'participation' => 'Encouraged but not always graded',
                    'diversity' => 'Extremely multicultural society',
                    'organizations' => 'Strong international student clubs',
                    'campus_life' => 'Outdoor activities, ice hockey, festivals',
                    'tip' => 'Canadians are famously polite and welcoming. Multiculturalism is official policy. Outdoor recreation is big - skiing, hiking. Winters are social despite cold. Tim Hortons is a cultural institution. Indigenous culture is increasingly celebrated.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1565299715199-866c917206bb?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Meal plans optional',
                    'halal' => 'Widely available in major cities',
                    'grocery' => 'No Frills, FreshCo for budget',
                    'eating_out' => 'CAD 12-20 per meal',
                    'cooking' => 'Most students cook at home',
                    'tip' => 'Large South Asian communities mean easy access to halal food and groceries. Food costs add up quickly eating out. Costco membership saves money for bulk buying. Student discounts common. Poutine is a must-try Canadian dish.'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Active Muslim Student Associations',
                    'prayer' => 'Prayer spaces in universities',
                    'centers' => 'Large South Asian communities',
                    'mentorship' => 'Peer support programs',
                    'iso' => 'Comprehensive international support',
                    'tip' => 'Canada has large and well-established Bangladeshi communities in Toronto, Vancouver, Montreal. Mosques and Islamic centers abundant. Society is very accepting and inclusive. Community support for newcomers is strong. Cultural festivals celebrated.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'Study Permit',
                    'processing' => '4-6 weeks online application',
                    'documents' => 'LOA, financial proof, medical',
                    'interview' => 'Rarely required',
                    'work' => 'PGWP: up to 3 years post-graduation',
                    'tip' => 'Canada offers most favorable post-study work and PR opportunities. Study permit allows 20 hrs/week work during study, full-time during breaks. PGWP length depends on program (2+ years = 3-year work permit). Express Entry pathway to PR.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'High school transcript main requirement',
                    'grad' => 'No GRE typically (some MBA programs)',
                    'english' => 'IELTS (6.5+), TOEFL (90+)',
                    'optional' => 'SAT/ACT not usually required',
                    'prep' => '2-3 months for English tests',
                    'tip' => 'Canadian universities focus on academic record over test scores. IELTS is most accepted English test. Some universities waive English test for students from English-medium schools. Personal statements and references important.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1527004013197-933c4bb611b3?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Varies greatly by region',
                    'winter' => 'Very cold (-10 to -30°C)',
                    'summer' => 'Pleasant (20-30°C)',
                    'vancouver' => 'Mild, rainy winters',
                    'prairies' => 'Extreme cold in winter',
                    'tip' => 'Invest in quality winter gear: parka, boots, gloves. Winter lasts 5-6 months in most regions. Vancouver has milder climate but more rain. Indoor facilities excellent. Heating included in most student housing. Canadians embrace winter sports.'
                ]
            ]
        ],
        'australia' => [
            'name' => 'Australia',
            'tagline' => 'World-Class Education Down Under',
            'hero_image' => 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '40+',
                'monthly_cost' => 'AUD 1,500',
                'students' => '400K+',
                'work_hours' => '20-40hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1624138784614-87fd1b6528f8?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => 'AUD 20,000 - 45,000/year',
                    'housing' => 'AUD 800 - 1,800/month',
                    'food' => 'AUD 400 - 600/month',
                    'transport' => 'AUD 100 - 200/month',
                    'insurance' => 'OSHC AUD 500-600/year',
                    'tip' => 'Sydney and Melbourne are most expensive. Adelaide, Brisbane offer good value. Share housing reduces costs. Working 20 hours/week can cover most living expenses. OSHC (health insurance) is mandatory.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'English (Australian accent)',
                    'tests' => 'IELTS (6.5+), TOEFL (79+), PTE (58+)',
                    'esl' => 'ELICOS courses available',
                    'admission' => 'Packaged with main program',
                    'support' => 'Academic skills workshops free',
                    'tip' => 'Australian slang takes getting used to. IELTS is preferred test. Universities offer free academic English support. Australians are informal and friendly. Practice understanding Australian accent before arrival.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Practical, hands-on learning',
                    'participation' => 'Active engagement expected',
                    'diversity' => 'Very multicultural, especially cities',
                    'organizations' => 'Beach culture, sports clubs',
                    'campus_life' => 'Outdoor lifestyle, BBQs, surfing',
                    'tip' => 'Australians value work-life balance. Beach and outdoor culture is huge. Laid-back atmosphere but take academics seriously. "No worries" is the national motto. Indigenous culture increasingly recognized. Sports, especially cricket and AFL, are big.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Limited meal plans, mostly self-catering',
                    'halal' => 'Readily available in cities',
                    'grocery' => 'Coles, Woolworths mainstream',
                    'eating_out' => 'AUD 15-25 per meal',
                    'cooking' => 'Most students cook themselves',
                    'tip' => 'Eating out is expensive. Large Asian and Middle Eastern populations mean excellent halal options. Aldi is budget-friendly. Farmers markets offer fresh produce. Aussie BBQ culture is great for socializing. Coffee culture is huge.'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Islamic Societies at all major unis',
                    'prayer' => 'Prayer rooms available',
                    'centers' => 'Growing South Asian communities',
                    'mentorship' => 'Buddy programs for newcomers',
                    'iso' => 'Excellent support services',
                    'tip' => 'Australia is very multicultural and welcoming. Muslim communities established in all major cities. Bangladeshi community growing rapidly. Universities have strong support for international students. Social life centers around outdoor activities.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1569144157591-c60f3f82f137?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'Student Visa (Subclass 500)',
                    'processing' => '4-6 weeks',
                    'documents' => 'CoE, GTE, financial capacity',
                    'interview' => 'Usually not required',
                    'work' => 'PSW visa: 2-4 years post-study',
                    'tip' => 'Biometrics required. Genuine Temporary Entrant (GTE) statement crucial. Show strong ties to Bangladesh. Post-study work rights depend on qualification (2 years for bachelor, 3 for masters, 4 for PhD). Work 40 hrs/fortnight during study.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'High school results (no SAT/ACT)',
                    'grad' => 'Generally no GRE required',
                    'english' => 'IELTS (6.5+), TOEFL iBT (79+)',
                    'optional' => 'PTE Academic accepted',
                    'prep' => '2-3 months for English test',
                    'tip' => 'Australian unis don\'t require SAT/GRE typically. IELTS and PTE most common English tests. Some unis waive English test for students from English-medium institutions. Focus on academic record and personal statement.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Reversed seasons (summer Dec-Feb)',
                    'summer' => 'Hot (25-40°C), can be extreme',
                    'winter' => 'Mild (10-20°C) in most cities',
                    'north' => 'Tropical, humid',
                    'south' => 'Temperate, four seasons',
                    'tip' => 'Remember seasons are opposite to northern hemisphere. Sunscreen essential year-round. December-February is summer (peak holiday season). Coastal cities have mild winters. Air conditioning important in summer. UV rays very strong.'
                ]
            ]
        ],
        'germany' => [
            'name' => 'Germany',
            'tagline' => 'Tuition-Free Education in Europe',
            'hero_image' => 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '100+',
                'monthly_cost' => '€850',
                'students' => '400K+',
                'work_hours' => '20hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1580519542036-c47de6196ba5?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => '€0 (public universities) + semester fee €150-350',
                    'housing' => '€300 - €600/month (student housing)',
                    'food' => '€200 - €300/month',
                    'transport' => '€30 - €60/month (semester ticket)',
                    'insurance' => '€110/month (mandatory)',
                    'tip' => 'Most public universities are tuition-free! Only pay semester contribution. Blocked account of €11,208 required for visa. Munich and Frankfurt expensive; Leipzig, Dresden affordable. Student jobs easy to find. Mensa (cafeteria) meals cheap.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1491841573634-28140fc7ced7?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'German (English programs available)',
                    'tests' => 'IELTS (6.0+), TOEFL (80+) for English programs',
                    'esl' => 'German language courses available',
                    'admission' => 'Many Master\'s in English',
                    'support' => 'Free German courses (Integrationskurs)',
                    'tip' => 'Learn German even for English programs - helps with daily life and job prospects. B1 German recommended minimum. Free German courses available. Many Master\'s programs in English, fewer Bachelor\'s. VHS offers cheap language classes.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1568792923760-d70635a89fdc?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Independent study, research-focused',
                    'participation' => 'Less emphasis on class participation',
                    'diversity' => 'Large international student community',
                    'organizations' => 'Student unions, cultural groups',
                    'campus_life' => 'Beer gardens, Christmas markets, hiking',
                    'tip' => 'Germans value punctuality and directness. University culture emphasizes independent research. More formal than Anglo-American systems. Strong work-life balance. Rich history and culture. Efficient public transport. Beer culture but many non-alcoholic options.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Mensa (cafeteria) very affordable',
                    'halal' => 'Available in most cities',
                    'grocery' => 'Aldi, Lidl, Rewe',
                    'eating_out' => '€8-15 per meal',
                    'cooking' => 'Common, kitchens in housing',
                    'tip' => 'Mensa meals cost €2-4. Large Turkish communities mean halal food widely available. Discount supermarkets save money. Bakeries offer cheap breakfast. Döner Kebab is ubiquitous. Sunday shopping closed (plan ahead). Tap water safe to drink.'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Islamic centers in major cities',
                    'prayer' => 'Some universities have prayer rooms',
                    'centers' => 'Large Muslim communities',
                    'mentorship' => 'Buddy programs common',
                    'iso' => 'International offices well-staffed',
                    'tip' => 'Germany has 5+ million Muslims, 3rd largest in Europe. Mosques in all cities. Growing Bangladeshi community. Germans generally reserved but warm up over time. Join Stammtisch (regular meetups) to make friends. Travel easily across Europe.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'Student Visa (National Visa)',
                    'processing' => '6-12 weeks (apply early!)',
                    'documents' => 'Admission letter, blocked account, insurance',
                    'interview' => 'At German Embassy Dhaka',
                    'work' => '18 months post-study job search visa',
                    'tip' => 'Book visa appointment months in advance. Blocked account (€11,208) mandatory. Get health insurance before applying. 120 full days/240 half days work allowed per year. After graduation, 18-month visa to find work. Blue Card for skilled workers.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'Studienkolleg if not eligible directly',
                    'grad' => 'No GRE typically required',
                    'english' => 'IELTS (6.0+), TOEFL (80+) for English programs',
                    'optional' => 'TestDAS, DSH for German programs',
                    'prep' => 'German language: 6-12 months',
                    'tip' => 'Bangladesh HSC may require Studienkolleg (foundation year) for direct Bachelor\'s admission. Master\'s applicants usually directly eligible. GRE not required. Learn German for better opportunities. Uni-assist processes most applications.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Temperate seasonal climate',
                    'winter' => 'Cold (0 to -5°C), snowy',
                    'summer' => 'Mild to warm (20-30°C)',
                    'autumn' => 'Beautiful foliage',
                    'spring' => 'Pleasant, flowers bloom',
                    'tip' => 'Four distinct seasons. Winter requires warm clothes but not extreme like Canada. Summer perfect for outdoor activities. Grey days common in winter. Heating included in rent usually. Christmas markets magical in December. Hiking popular in warmer months.'
                ]
            ]
        ],
        'japan' => [
            'name' => 'Japan',
            'tagline' => 'Innovation Meets Tradition',
            'hero_image' => 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?q=80&w=1920&auto=format&fit=crop',
            'stats' => [
                'universities' => '80+',
                'monthly_cost' => '¥120,000',
                'students' => '300K+',
                'work_hours' => '28hrs'
            ],
            'sections' => [
                'living_cost' => [
                    'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?q=80&w=1200&auto=format&fit=crop',
                    'tuition' => '¥535,800/year (national universities)',
                    'housing' => '¥30,000 - ¥80,000/month',
                    'food' => '¥30,000 - ¥50,000/month',
                    'transport' => '¥5,000 - ¥10,000/month',
                    'insurance' => '¥20,000/year (National Health)',
                    'tip' => 'MEXT scholarship covers everything - apply! Tokyo expensive but excellent public transport. Countryside much cheaper. Part-time work (28 hrs/week) helps cover living costs. Convenience stores (konbini) cheap and everywhere. Used bicycles save money.'
                ],
                'language' => [
                    'image' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1200&auto=format&fit=crop',
                    'primary' => 'Japanese (English programs growing)',
                    'tests' => 'IELTS/TOEFL for English programs',
                    'esl' => 'Japanese language schools common',
                    'admission' => 'Some English-taught programs',
                    'support' => 'Free Japanese classes at universities',
                    'tip' => 'Learn basic Japanese (hiragana, katakana) before arrival. English not widely spoken outside universities. Language barrier significant but manageable. Free Japanese courses at unis. Apps like HelloTalk help practice. Understanding Japanese crucial for daily life.'
                ],
                'culture' => [
                    'image' => 'https://images.unsplash.com/photo-1542051841857-5f90071e7989?q=80&w=1200&auto=format&fit=crop',
                    'style' => 'Structured, respect-based, group-oriented',
                    'participation' => 'Respectful, less confrontational',
                    'diversity' => 'Homogeneous but welcoming to students',
                    'organizations' => 'Clubs (サークル) very important',
                    'campus_life' => 'Festivals, temples, anime, manga',
                    'tip' => 'Japanese culture values harmony and respect. Bowing is important. Remove shoes indoors. Punctuality crucial. Group activities common. Clubs (circles) key to social life. Cherry blossom season beautiful. Onsen (hot springs) are cultural experience. Very safe country.'
                ],
                'food' => [
                    'image' => 'https://images.unsplash.com/photo-1563612116625-3012372fccce?q=80&w=1200&auto=format&fit=crop',
                    'campus' => 'Affordable cafeterias',
                    'halal' => 'Limited but growing (Tokyo, Kyoto better)',
                    'grocery' => 'Convenience stores ubiquitous',
                    'eating_out' => '¥500-1000 per meal',
                    'cooking' => 'Small kitchens, eat out culture',
                    'tip' => 'Halal food limited but improving. Muslim-friendly restaurants in major cities. Seafood-based Japanese food easier to navigate. Convenience store meals cheap and quality. Ramen, udon affordable. Many vegetarian options. Halal certification available. Learn to read labels (contains pork?).'
                ],
                'community' => [
                    'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop',
                    'msa' => 'Muslim Student Associations growing',
                    'prayer' => 'Some universities have prayer spaces',
                    'centers' => 'Mosques in major cities',
                    'mentorship' => 'Senpai-kohai system (senior-junior)',
                    'iso' => 'Dedicated international student support',
                    'tip' => 'Growing Muslim community (~200,000). Mosques in Tokyo, Osaka, Kyoto, Nagoya. Bangladeshi community small but supportive. Japanese are polite and helpful. International student events common. Join university circles to integrate. Travel domestically easy and beautiful.'
                ],
                'visa' => [
                    'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1200&auto=format&fit=crop',
                    'type' => 'Student Visa (Ryugaku)',
                    'processing' => '3-4 months (through university)',
                    'documents' => 'COE, financial proof, health check',
                    'interview' => 'Usually not required',
                    'work' => 'Designated Activities: job hunting after grad',
                    'tip' => 'University sponsors Certificate of Eligibility (COE) first, then apply for visa. Process takes time - start early. Financial proof required (~¥2M for year). Part-time work permit granted with visa. After graduation, can extend for job hunting. Skilled worker visa possible after employment.'
                ],
                'tests' => [
                    'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop',
                    'undergrad' => 'EJU (Examination for Japanese Universities)',
                    'grad' => 'Varies by university',
                    'english' => 'IELTS/TOEFL for English programs',
                    'optional' => 'JLPT N2 for Japanese programs',
                    'prep' => '6-12 months for Japanese',
                    'tip' => 'EJU required for undergraduate admission. Offered twice yearly. JLPT (Japanese Language Proficiency Test) useful for scholarships. Many universities have own entrance exams. MEXT scholarship has separate exam. English-taught programs increasing. GRE not typically required.'
                ],
                'weather' => [
                    'image' => 'https://images.unsplash.com/photo-1548407260-da850faa41e3?q=80&w=1200&auto=format&fit=crop',
                    'variation' => 'Four distinct seasons',
                    'spring' => 'Cherry blossoms (March-April), mild',
                    'summer' => 'Hot, humid (June-August)',
                    'autumn' => 'Beautiful foliage (September-November)',
                    'winter' => 'Cold (December-February), snow in north',
                    'tip' => 'Spring is magical with cherry blossoms but crowded. Summer hot and humid with rainy season (June-July). Autumn perfect weather and colors. Winter cold but not extreme (except Hokkaido). Typhoon season August-October. Air conditioning everywhere. Four seasons create distinct experiences.'
                ]
            ]
        ]
    ];

    // Check if country exists
    if (!isset($countries[$slug])) {
        abort(404);
    }

    $country = $countries[$slug];
    
    return view('countries.show', compact('country'));
})->name('countries.show');

// Blog Routes
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    // Placeholder for individual blog posts
    return view('blog.index');
})->name('blog.show');

// Contribute Route
Route::get('/contribute', function () {
    return view('contribute');
})->name('contribute');

// API Routes for AJAX
Route::get('/api/rankings', [UniversityRankingController::class, 'apiRankings'])->name('api.rankings');
Route::get('/api/search', [UniversityRankingController::class, 'search'])->name('api.search');

// Database Test Route (Remove after testing)
Route::get('/test-database', function() {
    $universities = \App\Models\University::whereNotNull('image_url')->take(10)->get();
    $subjects = \App\Models\Subject::where('category', 'specific')->take(10)->get();
    $stats = [
        'total_universities' => \App\Models\University::count(),
        'with_images' => \App\Models\University::whereNotNull('image_url')->count(),
        'total_subjects' => \App\Models\Subject::count(),
        'subject_links' => \Illuminate\Support\Facades\DB::table('subject_university')->count()
    ];
    return view('test-database', compact('universities', 'subjects', 'stats'));
})->name('test.database');
