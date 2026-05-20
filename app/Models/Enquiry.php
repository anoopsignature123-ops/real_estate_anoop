<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'associate_id',
        'source_id',
        'enquiry_types_id',
        'customer_name',
        'mobile_number',
        'email',
        'dob',
        'state',
        'city',
        'plot_size',
        'budget',
        'location',
        'followup_date',
    ];

    /**
     * Get the enquiry type associated with the enquiry.
     */
    public function enquiryType()
    {
        return $this->belongsTo(EnquiryType::class, 'enquiry_types_id');
    }

    public function associate()
    {
        return $this->belongsTo(Associate::class, 'associate_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
