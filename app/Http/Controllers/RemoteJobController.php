<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class RemoteJobController extends Controller
{
    /**
     * Display remote jobs with placeholder data for demonstration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Placeholder jobs for demonstration
        $allJobs = [
            [
                'id' => 1,
                'title' => 'Senior Full Stack Developer',
                'company_name' => 'TechCorp Inc.',
                'company_logo' => 'https://ui-avatars.com/api/?name=TechCorp&size=100&background=3B82F6&color=fff',
                'category' => 'Software Development',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$80,000 - $120,000',
                'description' => 'We are looking for an experienced Full Stack Developer to join our remote team. You will work on cutting-edge projects using modern technologies.',
                'tags' => ['React', 'Node.js', 'MongoDB', 'AWS'],
                'publication_date' => now()->subDays(2)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 2,
                'title' => 'UI/UX Designer',
                'company_name' => 'DesignHub',
                'company_logo' => 'https://ui-avatars.com/api/?name=DesignHub&size=100&background=8B5CF6&color=fff',
                'category' => 'Design',
                'job_type' => 'Full-time',
                'location' => 'Remote - Europe',
                'salary' => '$60,000 - $90,000',
                'description' => 'Join our creative team to design beautiful and intuitive user interfaces for web and mobile applications.',
                'tags' => ['Figma', 'Adobe XD', 'Sketch', 'Prototyping'],
                'publication_date' => now()->subDays(5)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 3,
                'title' => 'DevOps Engineer',
                'company_name' => 'CloudSystems',
                'company_logo' => 'https://ui-avatars.com/api/?name=CloudSystems&size=100&background=10B981&color=fff',
                'category' => 'DevOps',
                'job_type' => 'Contract',
                'location' => 'Remote - USA',
                'salary' => '$90,000 - $130,000',
                'description' => 'We need a skilled DevOps Engineer to manage our cloud infrastructure and CI/CD pipelines.',
                'tags' => ['Docker', 'Kubernetes', 'Jenkins', 'AWS'],
                'publication_date' => now()->subDays(1)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 4,
                'title' => 'Data Scientist',
                'company_name' => 'DataInsights Pro',
                'company_logo' => 'https://ui-avatars.com/api/?name=DataInsights&size=100&background=F59E0B&color=fff',
                'category' => 'Data Science',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$95,000 - $140,000',
                'description' => 'Looking for a Data Scientist to analyze complex datasets and build predictive models.',
                'tags' => ['Python', 'Machine Learning', 'TensorFlow', 'SQL'],
                'publication_date' => now()->subDays(3)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 5,
                'title' => 'Mobile App Developer',
                'company_name' => 'AppMakers Studio',
                'company_logo' => 'https://ui-avatars.com/api/?name=AppMakers&size=100&background=EF4444&color=fff',
                'category' => 'Mobile Development',
                'job_type' => 'Full-time',
                'location' => 'Remote - Asia',
                'salary' => '$70,000 - $110,000',
                'description' => 'Join our team to develop innovative mobile applications for iOS and Android platforms.',
                'tags' => ['React Native', 'Flutter', 'iOS', 'Android'],
                'publication_date' => now()->subDays(4)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 6,
                'title' => 'Backend Developer',
                'company_name' => 'ServerTech Solutions',
                'company_logo' => 'https://ui-avatars.com/api/?name=ServerTech&size=100&background=6366F1&color=fff',
                'category' => 'Software Development',
                'job_type' => 'Full-time',
                'location' => 'Remote - Europe',
                'salary' => '$75,000 - $115,000',
                'description' => 'We are seeking a Backend Developer proficient in building scalable APIs and microservices.',
                'tags' => ['Python', 'Django', 'PostgreSQL', 'Redis'],
                'publication_date' => now()->subDays(6)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 7,
                'title' => 'Frontend Developer',
                'company_name' => 'WebCraft Agency',
                'company_logo' => 'https://ui-avatars.com/api/?name=WebCraft&size=100&background=EC4899&color=fff',
                'category' => 'Software Development',
                'job_type' => 'Part-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$50,000 - $80,000',
                'description' => 'Create stunning user interfaces using modern frontend frameworks and best practices.',
                'tags' => ['Vue.js', 'CSS3', 'JavaScript', 'Tailwind'],
                'publication_date' => now()->subDays(7)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 8,
                'title' => 'Product Manager',
                'company_name' => 'InnovateLabs',
                'company_logo' => 'https://ui-avatars.com/api/?name=InnovateLabs&size=100&background=14B8A6&color=fff',
                'category' => 'Product Management',
                'job_type' => 'Full-time',
                'location' => 'Remote - USA/Canada',
                'salary' => '$100,000 - $150,000',
                'description' => 'Lead product strategy and development for our flagship SaaS platform.',
                'tags' => ['Agile', 'Scrum', 'Product Strategy', 'Analytics'],
                'publication_date' => now()->subDays(2)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 9,
                'title' => 'Cybersecurity Analyst',
                'company_name' => 'SecureNet Solutions',
                'company_logo' => 'https://ui-avatars.com/api/?name=SecureNet&size=100&background=DC2626&color=fff',
                'category' => 'Security',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$85,000 - $125,000',
                'description' => 'Protect our systems and data by implementing security best practices and monitoring threats.',
                'tags' => ['Security', 'Penetration Testing', 'SIEM', 'Compliance'],
                'publication_date' => now()->subDays(1)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 10,
                'title' => 'QA Engineer',
                'company_name' => 'QualityFirst Tech',
                'company_logo' => 'https://ui-avatars.com/api/?name=QualityFirst&size=100&background=7C3AED&color=fff',
                'category' => 'Quality Assurance',
                'job_type' => 'Full-time',
                'location' => 'Remote - Europe',
                'salary' => '$60,000 - $95,000',
                'description' => 'Ensure product quality through comprehensive testing strategies and automation.',
                'tags' => ['Selenium', 'Jest', 'API Testing', 'Automation'],
                'publication_date' => now()->subDays(3)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 11,
                'title' => 'Digital Marketing Specialist',
                'company_name' => 'GrowthMarketing Co',
                'company_logo' => 'https://ui-avatars.com/api/?name=GrowthMarketing&size=100&background=F97316&color=fff',
                'category' => 'Marketing',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$55,000 - $85,000',
                'description' => 'Drive growth through SEO, content marketing, and social media campaigns.',
                'tags' => ['SEO', 'Google Analytics', 'Content Marketing', 'Social Media'],
                'publication_date' => now()->subDays(4)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 12,
                'title' => 'Machine Learning Engineer',
                'company_name' => 'AI Innovations',
                'company_logo' => 'https://ui-avatars.com/api/?name=AI+Innovations&size=100&background=0EA5E9&color=fff',
                'category' => 'AI/ML',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$110,000 - $160,000',
                'description' => 'Build and deploy machine learning models to solve complex business problems.',
                'tags' => ['Python', 'PyTorch', 'NLP', 'Computer Vision'],
                'publication_date' => now()->subDays(5)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 13,
                'title' => 'Content Writer',
                'company_name' => 'ContentPro Agency',
                'company_logo' => 'https://ui-avatars.com/api/?name=ContentPro&size=100&background=8B5CF6&color=fff',
                'category' => 'Content',
                'job_type' => 'Freelance',
                'location' => 'Remote - Worldwide',
                'salary' => '$40,000 - $65,000',
                'description' => 'Create engaging content for blogs, websites, and marketing materials.',
                'tags' => ['Content Writing', 'SEO', 'Copywriting', 'Blogging'],
                'publication_date' => now()->subDays(6)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 14,
                'title' => 'Systems Administrator',
                'company_name' => 'NetOps Solutions',
                'company_logo' => 'https://ui-avatars.com/api/?name=NetOps&size=100&background=059669&color=fff',
                'category' => 'IT Operations',
                'job_type' => 'Full-time',
                'location' => 'Remote - USA',
                'salary' => '$70,000 - $105,000',
                'description' => 'Manage and maintain our IT infrastructure and server environments.',
                'tags' => ['Linux', 'Windows Server', 'Networking', 'Virtualization'],
                'publication_date' => now()->subDays(2)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 15,
                'title' => 'Business Analyst',
                'company_name' => 'BizIntel Corp',
                'company_logo' => 'https://ui-avatars.com/api/?name=BizIntel&size=100&background=D97706&color=fff',
                'category' => 'Business Analysis',
                'job_type' => 'Full-time',
                'location' => 'Remote - Europe',
                'salary' => '$65,000 - $100,000',
                'description' => 'Analyze business processes and recommend technology solutions to improve efficiency.',
                'tags' => ['Business Analysis', 'SQL', 'Excel', 'Power BI'],
                'publication_date' => now()->subDays(3)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 16,
                'title' => 'Cloud Architect',
                'company_name' => 'CloudFirst Technologies',
                'company_logo' => 'https://ui-avatars.com/api/?name=CloudFirst&size=100&background=3B82F6&color=fff',
                'category' => 'Cloud Computing',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$120,000 - $170,000',
                'description' => 'Design and implement enterprise-scale cloud solutions and migrations.',
                'tags' => ['AWS', 'Azure', 'GCP', 'Terraform'],
                'publication_date' => now()->subDays(1)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 17,
                'title' => 'Customer Success Manager',
                'company_name' => 'SuccessHub',
                'company_logo' => 'https://ui-avatars.com/api/?name=SuccessHub&size=100&background=10B981&color=fff',
                'category' => 'Customer Success',
                'job_type' => 'Full-time',
                'location' => 'Remote - USA/Canada',
                'salary' => '$70,000 - $100,000',
                'description' => 'Help customers achieve their goals and maximize value from our products.',
                'tags' => ['Customer Success', 'SaaS', 'Communication', 'CRM'],
                'publication_date' => now()->subDays(4)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 18,
                'title' => 'Blockchain Developer',
                'company_name' => 'CryptoTech Solutions',
                'company_logo' => 'https://ui-avatars.com/api/?name=CryptoTech&size=100&background=F59E0B&color=fff',
                'category' => 'Blockchain',
                'job_type' => 'Contract',
                'location' => 'Remote - Worldwide',
                'salary' => '$100,000 - $150,000',
                'description' => 'Develop decentralized applications and smart contracts on various blockchain platforms.',
                'tags' => ['Solidity', 'Ethereum', 'Web3', 'Smart Contracts'],
                'publication_date' => now()->subDays(5)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 19,
                'title' => 'Graphic Designer',
                'company_name' => 'CreativeMinds Studio',
                'company_logo' => 'https://ui-avatars.com/api/?name=CreativeMinds&size=100&background=EC4899&color=fff',
                'category' => 'Design',
                'job_type' => 'Part-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$45,000 - $75,000',
                'description' => 'Create visual content for digital and print media including logos, banners, and marketing materials.',
                'tags' => ['Photoshop', 'Illustrator', 'Branding', 'Typography'],
                'publication_date' => now()->subDays(7)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 20,
                'title' => 'Video Editor',
                'company_name' => 'MediaPro Studios',
                'company_logo' => 'https://ui-avatars.com/api/?name=MediaPro&size=100&background=EF4444&color=fff',
                'category' => 'Video Production',
                'job_type' => 'Freelance',
                'location' => 'Remote - Worldwide',
                'salary' => '$50,000 - $80,000',
                'description' => 'Edit and produce high-quality video content for YouTube, social media, and corporate clients.',
                'tags' => ['Premiere Pro', 'After Effects', 'Video Editing', 'Motion Graphics'],
                'publication_date' => now()->subDays(2)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 21,
                'title' => 'Sales Development Representative',
                'company_name' => 'SalesForce Pro',
                'company_logo' => 'https://ui-avatars.com/api/?name=SalesForce&size=100&background=06B6D4&color=fff',
                'category' => 'Sales',
                'job_type' => 'Full-time',
                'location' => 'Remote - USA',
                'salary' => '$55,000 - $85,000 + Commission',
                'description' => 'Generate and qualify leads to drive revenue growth for our B2B SaaS platform.',
                'tags' => ['Sales', 'Lead Generation', 'CRM', 'B2B'],
                'publication_date' => now()->subDays(3)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 22,
                'title' => 'Technical Writer',
                'company_name' => 'DocuTech Solutions',
                'company_logo' => 'https://ui-avatars.com/api/?name=DocuTech&size=100&background=6366F1&color=fff',
                'category' => 'Technical Writing',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$60,000 - $90,000',
                'description' => 'Create clear and comprehensive technical documentation, user guides, and API references.',
                'tags' => ['Technical Writing', 'Documentation', 'API Docs', 'Markdown'],
                'publication_date' => now()->subDays(4)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 23,
                'title' => 'Scrum Master',
                'company_name' => 'AgileWorks Inc',
                'company_logo' => 'https://ui-avatars.com/api/?name=AgileWorks&size=100&background=7C3AED&color=fff',
                'category' => 'Project Management',
                'job_type' => 'Full-time',
                'location' => 'Remote - Europe',
                'salary' => '$75,000 - $110,000',
                'description' => 'Facilitate agile ceremonies and help teams deliver high-quality software efficiently.',
                'tags' => ['Scrum', 'Agile', 'JIRA', 'Team Facilitation'],
                'publication_date' => now()->subDays(6)->format('Y-m-d'),
                'url' => '#'
            ],
            [
                'id' => 24,
                'title' => 'Game Developer',
                'company_name' => 'GameStudio Elite',
                'company_logo' => 'https://ui-avatars.com/api/?name=GameStudio&size=100&background=DC2626&color=fff',
                'category' => 'Game Development',
                'job_type' => 'Full-time',
                'location' => 'Remote - Worldwide',
                'salary' => '$70,000 - $115,000',
                'description' => 'Develop engaging games for mobile and PC platforms using Unity or Unreal Engine.',
                'tags' => ['Unity', 'C#', 'Game Design', '3D Graphics'],
                'publication_date' => now()->subDays(1)->format('Y-m-d'),
                'url' => '#'
            ],
        ];

        $totalJobs = count($allJobs);
        
        // Handle pagination manually
        $perPage = 21; // Number of jobs per page
        $currentPage = $request->query('page', 1);
        
        // Slice the array to get only the jobs for current page
        $currentPageJobs = array_slice($allJobs, ($currentPage - 1) * $perPage, $perPage);
        
        // Create a custom paginator
        $jobs = new LengthAwarePaginator(
            $currentPageJobs, 
            $totalJobs, 
            $perPage, 
            $currentPage, 
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        return view('jobs.remote', [
            'jobs' => $jobs,
            'jobsCount' => $totalJobs,
        ]);
    }
}