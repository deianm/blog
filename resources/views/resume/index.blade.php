@extends('layouts.app')
@section('title','Deian Mosolov')
@section('content')

    <title>Deian Mosolov</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Deian Mosolov">
    <meta name="author" content="Deian Mosolov">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<div class="wrapper">
    <div class="sidebar-wrapper">
        <div class="profile-container">
            <img class="profile" style="height:120px;" src="/storage/images/6ce055103ca7e680fc8403863e8fb929.jpeg" alt="" />
            <h1 class="name">Deian Mosolov</h1>
            <h3 class="tagline">PHP Developer</h3>
        </div><!--//profile-container-->

        <div class="contact-container container-block">
            <ul class="list-unstyled contact-list">
                <li class="email"><i class="fa fa-envelope"></i><a href="mailto: deian.mosolov@gmail.com">deian.mosolov@gmail.com</a></li>
                <li class="phone"><i class="fa fa-phone"></i><a href="tel:678 789 5946">(678) 789-5946</a></li>
                <li class="website"><i class="fa fa-globe"></i><a href="http://deian-mosolov.com" target="_blank">deian-mosolov.com</a></li>
                <li class="linkedin"><i class="fa fa-linkedin"></i><a href="https://www.linkedin.com/in/deianmosolov" target="_blank">Linkedin</a></li>
                <li class="github"><i class="fa fa-github"></i><a href="https://github.com/deianm" target="_blank">Github</a></li>
               <!-- <li class="twitter"><i class="fa fa-twitter"></i><a href="https://twitter.com/3rdwave_themes" target="_blank">@twittername</a></li> -->
            </ul>
        </div><!--//contact-container-->


        <div class="interests-container container-block">
            <h2 class="container-block-title">Address</h2>
            <ul class="list-unstyled interests-list">
                <li>398 Boulevard NE Atlanta, GA 30308</li>
            </ul>
        </div><!--//interests-->

        <div class="education-container container-block">
            <h2 class="container-block-title">Education</h2>
            <div class="item">
                <h4 class="degree">Information Technology</h4>
                <h5 class="meta">Year Up</h5>
                <div class="time">2015 - 2016</div>
            </div><!--//item-->
        </div><!--//education-container-->

        <div class="languages-container container-block">
            <h2 class="container-block-title">Languages</h2>
            <ul class="list-unstyled interests-list">
                <li>Russian <span class="lang-desc">(Native)</span></li>
                <li>English <span class="lang-desc">(Professional)</span></li>
            </ul>
        </div><!--//interests-->

        <div class="interests-container container-block">
            <h2 class="container-block-title">Interests</h2>
            <ul class="list-unstyled interests-list">
                <li>Cooking</li>
                <li>Gaming</li>
                <li>Anime</li>
                <li>Programming</li>
            </ul>
        </div><!--//interests-->

    </div><!--//sidebar-wrapper-->

    <div class="main-wrapper">

        <section class="section summary-section">
            <h2 class="section-title"><i class="fa fa-user"></i>Summary</h2>
            <div class="summary">
            <p>A conscientious, fast learner offering the ability to assess an organization’s needs and create a complementary, robust web experience. Experienced in numerous stages of the web development process including: information gathering, planning, design, development, testing and delivery. Proficient with a wide array of skills and web libraries.</p>
            </div><!--//summary-->
        </section><!--//section-->

        <section class="skills-section section">
            <h2 class="section-title"><i class="fa fa-rocket"></i>Skills</h2>
            <div class="skillset">
                <div class="item">
                    <h3 class="level-title">Professional</h3>
                    <div >
                        <p>
                            Web Application Development (strong focus on CMS), PHP, MySQL, jQuery, REST API integration
                        </p>
                    </div><!--//level-bar-->
                </div><!--//item-->

                <div class="item">
                    <h3 class="level-title">Technologies</h3>
                    <div>
                        <p>
                            Technologies - PHP(5, and 7) MariaDB, HTML, CSS, JavaScript, jQuery, Ajax, JSON, Laravel Framework (MVC framework), Git Version Control, Datatables, Bootstrap, Ubuntu (14.04 and 16.04), WinSCP, Lua
                        </p>
                    </div><!--//level-bar-->
                </div><!--//item-->

                <div class="item">
                    <h3 class="level-title">Applications</h3>
                    <div>
                        <p>
                            PhpStorm IDE, WordPress, Toad, MySQL Workbench, Tower, Source Tree, Git Kraken, Git Bash, XAMPP, WAMP, FileZilla, Oracle VM, MS Visual Studios, MS SQL Server 2014, Composer, Beyond Compare, WinSCP, Kitty, Axosoft, JIRA, Firebug
                        </p>
                    </div><!--//level-bar-->
                </div><!--//item-->
            </div>
        </section><!--//skills-section-->

        <section class="section experiences-section">
            <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiences</h2>

            <div class="item">
                <div class="meta">
                    <div class="upper-row">
                        <h3 class="job-title">PHP Developer</h3>
                        <div class="time">02/2016 - Present</div>
                    </div><!--//upper-row-->
                    <div class="company">Kode3 Web Solutions, Acworth</div>
                </div><!--//meta-->
                <div class="details">
                    <ul>
                        <li>Developing and improving several custom functionality for existing clients applications</li>
                        <li>Refactoring massive codebase and normalizing databases</li>
                        <li>Integrating APIs (PayPal, Authorize.Net, various Google APIs, Dark Sky Weather, various Advertising APIs)</li>
                        <li>Building Content Management Systems for clients’ financial portals using various technologies</li>
                        <li>Configuring Ubuntu 14.04 and 16.04 on AWS services for LAMP stack</li>
                        <li>Managing over 40 WordPress websites using WP-Main</li>
                    </ul>
                </div><!--//details-->
            </div><!--//item-->

            <div class="item">
                <div class="meta">
                    <div class="upper-row">
                        <h3 class="job-title">Project Coordinator | PHP Developer</h3>
                        <div class="time">08/2015 – 01/2016</div>
                    </div><!--//upper-row-->
                    <div class="company">UCB Pharma, Smyrna</div>
                </div><!--//meta-->
                <div class="details">
                    <ul>
                        <li>Designing and  developing Portfolio Management Application and Material Deviation application</li>
                        <li>Managing project execution to ensure adherence to schedule and scope</li>
                        <li>Developing content criteria with key stakeholders to prioritize needs</li>
                        <li>Working with management and IT teams to choose solutions, coordinate activities, and resolve conflicts</li>
                    </ul>
                </div><!--//details-->
            </div><!--//item-->
        </section><!--//section-->

        <section class="section projects-section">
            <h2 class="section-title"><i class="fa fa-archive"></i>Projects</h2>
            <div class="intro">
                <p>Some of the projects are restricted and cannot be viewed.</p>
            </div><!--//intro-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a style="text-decoration: none;">Clear Technologies Dashboard</a></span>
                <ul>
                    <li>Designed and planned the project to meet the clients needs</li>
                    <li>Crated a management application use Laravel 4.3 framework (MVC) using Bootstrap and Datatables with server side processing</li>
                    <li>The application allowed management of the clients by uploading excel spreadsheet, and perform multiple functions</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a href="http://www.fans2cash.co/" target="_blank">Fans2Cash (Continuous Integration)</a></span>
                <ul>
                    <li>Rewriting and refactoring poor and insecure codebase which was using a lot of deprecated PHP functions</li>
                    <li>Implementing secure file uploads for user profile information</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a style="text-decoration: none;">Fans2Cash Dashboard (Continuous Integration)</a></span>
                <ul>
                    <li>Adding several reports on the dashboard using Datatables and updated several static tables to use server side processing for faster page load</li>
                    <li>Creating several commands (hourly, daily, weekly) for several complex crons that record users financial earnings to store in the archives</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a href="https://www.caribbeanwinds.com/" target="_blank">Caribbean Winds</a></span>
                <ul>
                    <li>Integrated a weather API along with a cache system to reduce the amount of API calls to reduce the costs</li>
                    <li>Worked on an email notification system to allow the client to track fatal payment errors</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a href="https://www.creditsaint.com/" target="_blank">Credit Saint</a></span>
                <ul>
                    <li>Redesigned the flow of the form for a much smoother user experience</li>
                    <li>Fixed several security problems with the form that was collecting users sensitive financial information</li>
                    <li>Created JavaScript and PHP validation for the form</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a style="text-decoration: none;">Portfolio Management Application</a></span>
                <ul>
                    <li>Acted as the principal architect and developer during the full life-cycle: Gathered requirements, designed the solution, configured servers, coded the application, created graphics, and designed reports</li>
                    <li>Used to track corporate applications globally to facilitate annual budget planning and eliminate functional redundancies to reduce overhead costs</li>
                    <li>One-time and reoccurring costs are entered in regional currencies, tracked by cost centers, which roll-up into managerial reporting hierarchies</li>
                </ul>
            </div><!--//item-->

            <div class="item">
                <span style="font-weight: bold;" class="project-title"><a style="text-decoration: none;">Material Deviation Application</a></span>
                <ul>
                    <li>Web based application to manage deviations: capture, planning, resolution, and reporting</li>
                    <li>Achieved 67% reduction in time to address deviations over the previous business process utilizing email</li>
                </ul>
            </div><!--//item-->
        </section><!--//section-->

        <section class="section experiences-section">
            <h2 class="section-title"><i class="fa fa-briefcase"></i>Education</h2>

            <div class="item">
                <div class="meta">
                    <div class="upper-row">
                        <h3 class="job-title">Student | Intern</h3>
                        <div class="time">01/2015 - 01/2016</div>
                    </div><!--//upper-row-->
                    <div class="company">Year Up, Atlanta</div>
                </div><!--//meta-->
                <div class="details">
                    <p>- Year Up is a leading one-year career development program with 250 corporate partners around the country; the program includes college-level courses, professional training, and six-moth internship.</p>
                    <p>- Relevant courses include: Desktop support, IT helpdesk, Computer networking, Business writing, professional skills, software installation, and customer service.</p>
                </div><!--//details-->
            </div><!--//item-->
        </section><!--//section-->

    </div><!--//main-body-->
</div>

<!-- custom js -->
<script type="text/javascript" src="assets/js/main.js"></script>

@endsection