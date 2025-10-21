@extends('layouts.main')

@section('title', $subject->name . ' Rankings 2026 - Bangladeshis Beyond Border')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #0f2025 0%, #113339 100%); padding: 40px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px); border-radius: 16px; padding: 40px; margin-bottom: 30px; text-align: center;">
            <div style="font-size: 2.5em; font-weight: bold; color: #ffffff; margin-bottom: 10px;">
                {{ $subject->icon }} {{ $subject->name }}
            </div>
            <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.1em; max-width: 800px; margin: 0 auto;">
                {{ $subject->description ?? 'Explore the world\'s top universities for ' . $subject->name }}
            </p>
        </div>

        <!-- Breadcrumb Navigation -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('home') }}" style="color: #38bdf8; text-decoration: none;">Home</a>
            <span style="color: #99a9ad; margin: 0 10px;">/</span>
            <a href="{{ route('subjects.browse') }}" style="color: #38bdf8; text-decoration: none;">Subject Rankings</a>
            <span style="color: #99a9ad; margin: 0 10px;">/</span>
            <span style="color: #ffffff;">{{ $subject->name }}</span>
        </div>

        <!-- Filters Section -->
        <div style="background: rgba(17, 51, 58, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); border-radius: 12px; padding: 25px; margin-bottom: 30px;">
            <form method="GET" action="{{ route('rankings.by-subject', $subject->slug) }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                
                <!-- Region Filter -->
                <div>
                    <label style="color: #99a9ad; font-size: 0.9em; display: block; margin-bottom: 5px;">Region</label>
                    <select name="region" style="width: 100%; padding: 10px; background: rgba(15, 32, 37, 0.8); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 6px; color: #ffffff; font-size: 0.95em;" onchange="this.form.submit()">
                        <option value="">All Regions</option>
                        @foreach($regions as $r)
                            <option value="{{ $r }}" {{ request('region') == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Country Filter -->
                <div>
                    <label style="color: #99a9ad; font-size: 0.9em; display: block; margin-bottom: 5px;">Country</label>
                    <select name="country" style="width: 100%; padding: 10px; background: rgba(15, 32, 37, 0.8); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 6px; color: #ffffff; font-size: 0.95em;" onchange="this.form.submit()">
                        <option value="">All Countries</option>
                        @foreach($countries->sortBy('country') as $c)
                            <option value="{{ $c->country }}" {{ request('country') == $c->country ? 'selected' : '' }}>{{ $c->country }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Clear Filters -->
                @if(request('region') || request('country'))
                    <div style="display: flex; align-items: flex-end;">
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" style="display: inline-block; padding: 10px 20px; background: rgba(56, 189, 248, 0.2); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 6px; text-decoration: none; text-align: center; transition: all 0.3s ease;">
                            Clear Filters
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Results Count -->
        <div style="color: #99a9ad; margin-bottom: 20px; font-size: 0.95em;">
            Showing <strong style="color: #ffffff;">{{ $universities->total() }}</strong> universities
        </div>

        <!-- Universities List -->
        <div style="display: grid; gap: 20px;">
            @forelse($universities as $index => $university)
                <div style="background: rgba(17, 51, 58, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.1); border-radius: 12px; padding: 25px; transition: all 0.3s ease; display: grid; grid-template-columns: auto 1fr auto; gap: 20px; align-items: start;" 
                     onmouseover="this.style.transform='translateX(5px)'; this.style.borderColor='rgba(56, 189, 248, 0.5)'; this.style.boxShadow='0 5px 20px rgba(56, 189, 248, 0.2)';" 
                     onmouseout="this.style.transform='translateX(0)'; this.style.borderColor='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='none';">
                    
                    <!-- Rank Badge -->
                    <div style="min-width: 60px; text-align: center;">
                        <div style="font-size: 2em; font-weight: bold; color: #38bdf8;">
                            #{{ $university->pivot->rank ?? ($index + 1) }}
                        </div>
                        @if($university->pivot->score)
                            <div style="font-size: 0.85em; color: #99a9ad; margin-top: 5px;">
                                Score: {{ number_format($university->pivot->score, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- University Info -->
                    <div>
                        <!-- University Logo & Name -->
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            @if($university->logo)
                                <img src="{{ $university->logo }}" alt="{{ $university->name }}" style="width: 50px; height: 50px; object-fit: contain; background: white; padding: 5px; border-radius: 8px;">
                            @endif
                            <div>
                                <h3 style="color: #ffffff; font-size: 1.3em; margin: 0;">
                                    <a href="{{ route('rankings.show', $university->slug) }}" style="color: #ffffff; text-decoration: none;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#ffffff'">
                                        {{ $university->name }}
                                    </a>
                                </h3>
                                <div style="color: #99a9ad; font-size: 0.9em; margin-top: 5px;">
                                    <span>{{ $university->city }}, {{ $university->country }}</span>
                                    @if($university->type)
                                        <span style="margin-left: 10px; padding: 2px 8px; background: rgba(56, 189, 248, 0.2); border-radius: 4px; font-size: 0.85em;">
                                            {{ ucfirst($university->type) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Highlights (if available) -->
                        @if($university->pivot->highlights)
                            <div style="color: #99a9ad; font-size: 0.95em; line-height: 1.6; margin-top: 10px; padding: 15px; background: rgba(56, 189, 248, 0.05); border-left: 3px solid #38bdf8; border-radius: 4px;">
                                <strong style="color: #38bdf8;">Highlights:</strong> {{ $university->pivot->highlights }}
                            </div>
                        @endif

                        <!-- Quick Info -->
                        <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                            @if($university->founded_year)
                                <div style="color: #99a9ad; font-size: 0.9em;">
                                    <span style="color: #38bdf8;">📅</span> Founded {{ $university->founded_year }}
                                </div>
                            @endif
                            @if($university->student_count)
                                <div style="color: #99a9ad; font-size: 0.9em;">
                                    <span style="color: #38bdf8;">👥</span> {{ number_format($university->student_count) }} students
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 10px; min-width: 150px;">
                        <a href="{{ route('rankings.show', $university->slug) }}" style="display: block; padding: 10px 20px; background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); color: white; text-decoration: none; border-radius: 6px; text-align: center; font-size: 0.9em; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(56, 189, 248, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            View Details
                        </a>
                        @if($university->website)
                            <a href="{{ $university->website }}" target="_blank" style="display: block; padding: 10px 20px; background: rgba(56, 189, 248, 0.1); color: #38bdf8; text-decoration: none; border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 6px; text-align: center; font-size: 0.9em; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(56, 189, 248, 0.2)';" onmouseout="this.style.background='rgba(56, 189, 248, 0.1)';">
                                Official Website
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2); border-radius: 12px; padding: 40px; text-align: center;">
                    <div style="font-size: 3em; margin-bottom: 20px;">🔍</div>
                    <p style="color: #99a9ad; font-size: 1.1em; margin-bottom: 20px;">No universities found for this subject yet.</p>
                    <p style="color: #99a9ad; font-size: 0.95em; margin-bottom: 30px;">We're working on adding more subject rankings. Check back soon!</p>
                    <a href="{{ route('subjects.browse') }}" style="display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); color: white; text-decoration: none; border-radius: 8px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        Browse All Subjects
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($universities->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $universities->links() }}
            </div>
        @endif

        <!-- Explore More Subjects -->
        <div style="margin-top: 40px; background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2); border-radius: 12px; padding: 30px; text-align: center;">
            <h3 style="color: #ffffff; margin-bottom: 15px; font-size: 1.5em;">Explore More Subjects</h3>
            <p style="color: #99a9ad; margin-bottom: 20px;">Browse rankings for other academic disciplines</p>
            <a href="{{ route('subjects.browse') }}" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: bold; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                View All Subject Rankings
            </a>
        </div>
    </div>
</div>
@endsection
