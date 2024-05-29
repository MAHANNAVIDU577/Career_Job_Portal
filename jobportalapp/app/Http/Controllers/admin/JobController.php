<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'DESC')->with('user','applications')->paginate(10);
        return view('admin.jobs.list',[
            'jobs' => $jobs
        ]);
    }
    public function edit($id){
        $job = Job::findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->get();
        
        return view('admin.jobs.edit',[
            'job' => $job,
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }
}
