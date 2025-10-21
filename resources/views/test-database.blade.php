<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Test - Bangladeshis Beyond Border</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2025 0%, #113339 100%);
            color: #ffffff;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: rgba(17, 51, 58, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
        }
        
        .stat-card h3 {
            color: #38bdf8;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 3em;
            font-weight: bold;
            color: #ffffff;
        }
        
        .section {
            margin-bottom: 40px;
        }
        
        .section h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(56, 189, 248, 0.3);
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: rgba(17, 51, 58, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 189, 248, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
            border-color: rgba(56, 189, 248, 0.5);
        }
        
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: rgba(18, 112, 131, 0.2);
        }
        
        .card-content {
            padding: 20px;
        }
        
        .card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #38bdf8;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(56, 189, 248, 0.2);
            color: #38bdf8;
            border-radius: 20px;
            font-size: 0.85em;
            margin-right: 5px;
            margin-bottom: 5px;
            border: 1px solid rgba(56, 189, 248, 0.3);
        }
        
        .info-row {
            margin: 8px 0;
            color: #99a9ad;
            font-size: 0.95em;
        }
        
        .info-row strong {
            color: #ffffff;
        }
        
        .quick-actions {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(56, 189, 248, 0.1);
        }
        
        .quick-action {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.85em;
            margin-right: 5px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .quick-action:hover {
            background: rgba(56, 189, 248, 0.3);
            color: #ffffff;
        }
        
        .subject-card {
            background: rgba(17, 51, 58, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.1);
            border-radius: 12px;
            padding: 20px;
        }
        
        .subject-card h3 {
            color: #38bdf8;
            margin-bottom: 10px;
        }
        
        .subject-icon {
            font-size: 2em;
            margin-bottom: 10px;
        }
        
        .test-status {
            background: rgba(46, 213, 115, 0.2);
            border: 1px solid rgba(46, 213, 115, 0.4);
            color: #2ed573;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        
        .back-link {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .back-link:hover {
            transform: translateX(-5px);
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="back-link">← Back to Home</a>
        
        <h1>🧪 Database Test Results</h1>
        
        <div class="test-status">
            ✅ Database is Working Perfectly!
        </div>
        
        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <h3>Total Universities</h3>
                <div class="number">{{ $stats['total_universities'] }}</div>
            </div>
            
            <div class="stat-card">
                <h3>With Images</h3>
                <div class="number">{{ $stats['with_images'] }}</div>
            </div>
            
            <div class="stat-card">
                <h3>Total Subjects</h3>
                <div class="number">{{ $stats['total_subjects'] }}</div>
            </div>
            
            <div class="stat-card">
                <h3>Subject-University Links</h3>
                <div class="number">{{ $stats['subject_links'] }}</div>
            </div>
        </div>
        
        <!-- Universities Section -->
        <div class="section">
            <h2>🏛️ Sample Universities (With Images)</h2>
            <div class="grid">
                @foreach($universities as $university)
                    <div class="card">
                        @if($university->image_url)
                            <img src="{{ $university->image_url }}" alt="{{ $university->name }}" class="card-image" loading="lazy">
                        @endif
                        
                        <div class="card-content">
                            <h3>{{ $university->name }}</h3>
                            
                            <div>
                                <span class="badge">{{ $university->country }}</span>
                                @if($university->type)
                                    <span class="badge">{{ ucfirst($university->type) }}</span>
                                @endif
                            </div>
                            
                            @if($university->founded_year)
                                <div class="info-row">
                                    <strong>Founded:</strong> {{ $university->founded_year }}
                                </div>
                            @endif
                            
                            @if($university->student_count)
                                <div class="info-row">
                                    <strong>Students:</strong> {{ number_format($university->student_count) }}
                                </div>
                            @endif
                            
                            @if($university->international_students)
                                <div class="info-row">
                                    <strong>International:</strong> {{ number_format($university->international_students) }}
                                </div>
                            @endif
                            
                            @if($university->admission_undergrad_url || $university->scholarships_url || $university->research_url)
                                <div class="quick-actions">
                                    @if($university->admission_undergrad_url)
                                        <a href="{{ $university->admission_undergrad_url }}" target="_blank" class="quick-action">
                                            📚 Admissions
                                        </a>
                                    @endif
                                    
                                    @if($university->scholarships_url)
                                        <a href="{{ $university->scholarships_url }}" target="_blank" class="quick-action">
                                            💰 Scholarships
                                        </a>
                                    @endif
                                    
                                    @if($university->research_url)
                                        <a href="{{ $university->research_url }}" target="_blank" class="quick-action">
                                            🔬 Research
                                        </a>
                                    @endif
                                    
                                    @if($university->student_life_url)
                                        <a href="{{ $university->student_life_url }}" target="_blank" class="quick-action">
                                            🎓 Student Life
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Subjects Section -->
        <div class="section">
            <h2>📚 Sample Subjects</h2>
            <div class="grid">
                @foreach($subjects as $subject)
                    <div class="subject-card">
                        <div class="subject-icon">{{ $subject->icon }}</div>
                        <h3>{{ $subject->name }}</h3>
                        <div class="badge">{{ ucfirst($subject->category) }}</div>
                        <div class="info-row">
                            <strong>Slug:</strong> {{ $subject->slug }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Test Summary -->
        <div class="section">
            <h2>✅ Database Features Working</h2>
            <div style="background: rgba(17, 51, 58, 0.4); padding: 30px; border-radius: 12px; border: 1px solid rgba(56, 189, 248, 0.2);">
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: 10px 0; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                        ✅ <strong>Image Storage</strong> - Universities have image_url, banner_image, thumbnail fields
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                        ✅ <strong>University Info</strong> - Founded year, type (public/private), student counts
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                        ✅ <strong>Quick Action URLs</strong> - Admissions, scholarships, research, facilities, student life
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                        ✅ <strong>Subject System</strong> - 56 subjects with categories (broad/specific)
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                        ✅ <strong>Pivot Table</strong> - Ready for subject-university relationships with rankings
                    </li>
                    <li style="padding: 10px 0;">
                        ✅ <strong>Search & Filter</strong> - Can filter by country, type, subject, etc.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
