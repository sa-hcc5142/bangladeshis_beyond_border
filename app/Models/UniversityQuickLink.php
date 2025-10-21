<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityQuickLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'undergraduate_admission_url',
        'postgraduate_admission_url',
        'academic_timeline_url',
        'fullride_scholarship_url',
        'partial_scholarship_url',
        'more_info_url',
        'last_scraped_at',
        'scraping_completed',
    ];

    protected $casts = [
        'last_scraped_at' => 'datetime',
        'scraping_completed' => 'boolean',
    ];

    /**
     * Get the university that owns the quick links.
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Get URL with fallback to university website
     */
    public function getUrlWithFallback($type, $fallbackUrl)
    {
        $url = $this->{$type . '_url'};
        return $url ?: $fallbackUrl;
    }

    /**
     * Check if all links are populated
     */
    public function isComplete()
    {
        return !empty($this->undergraduate_admission_url)
            && !empty($this->postgraduate_admission_url)
            && !empty($this->academic_timeline_url)
            && !empty($this->fullride_scholarship_url)
            && !empty($this->partial_scholarship_url)
            && !empty($this->more_info_url);
    }
}
