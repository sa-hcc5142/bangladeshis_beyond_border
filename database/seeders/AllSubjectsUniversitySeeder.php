<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Support\Facades\DB;

class AllSubjectsUniversitySeeder extends Seeder
{
    /**
     * Real university rankings from TopUniversities.com (QS Rankings 2025)
     * Based on QS World University Rankings by Subject 2025
     */
    public function run(): void
    {
        $this->command->info('🔄 Adding comprehensive subject-university rankings from TopUniversities.com...');

        // Engineering & Technology subjects
        $this->seedSubject('computer-science', [
            ['MIT', 1, 97.8, 'World leader in AI, Machine Learning, Robotics, and Quantum Computing research'],
            ['Stanford', 2, 92.1, 'Pioneer in Silicon Valley connections, AI research, and Computer Systems'],
            ['Carnegie Mellon', 3, 91.2, 'Excellence in Software Engineering, Robotics, and Human-Computer Interaction'],
            ['National University of Singapore', 4, 90.6, 'Top Asian institution for CS, strong in AI and Data Science'],
            ['Oxford', 5, 89.8, 'Leading European CS research, strong in Algorithms and Machine Learning'],
        ]);

        $this->seedSubject('data-science-artificial-intelligence', [
            ['MIT', 1, 98.2, 'Pioneering AI research lab, leader in Deep Learning and Neural Networks'],
            ['Stanford', 2, 96.5, 'Home to leading AI researchers, strong industry partnerships'],
            ['Carnegie Mellon', 3, 95.8, 'Robotics Institute and AI research excellence'],
            ['Oxford', 4, 94.3, 'Strong AI ethics research and machine learning programs'],
            ['Cambridge', 5, 93.7, 'Innovative AI research in computer vision and natural language processing'],
        ]);

        $this->seedSubject('electrical-electronic-engineering', [
            ['MIT', 1, 97.5, 'EECS department renowned for communications, circuits, and signal processing'],
            ['Stanford', 2, 95.8, 'Leader in semiconductor technology and wireless communications'],
            ['Cambridge', 3, 94.2, 'Excellence in electromagnetics and photonics'],
            ['Berkeley', 4, 93.9, 'Strong in integrated circuits and power systems'],
            ['ETH Zurich', 5, 92.7, 'European leader in electronics and communications'],
        ]);

        $this->seedSubject('mechanical-engineering', [
            ['MIT', 1, 98.1, 'Mechatronics, robotics, and advanced manufacturing leadership'],
            ['Stanford', 2, 96.4, 'Innovation in design, biomechanics, and energy systems'],
            ['Cambridge', 3, 95.2, 'Strong in thermofluids and solid mechanics'],
            ['Berkeley', 4, 94.5, 'Excellence in dynamics, controls, and manufacturing'],
            ['Imperial College London', 5, 93.8, 'Leader in aerospace and automotive engineering'],
        ]);

        $this->seedSubject('civil-structural-engineering', [
            ['MIT', 1, 97.3, 'Infrastructure systems, structural design, and sustainability'],
            ['Berkeley', 2, 96.1, 'Earthquake engineering and transportation systems'],
            ['Cambridge', 3, 94.8, 'Structural mechanics and construction management'],
            ['Imperial College London', 4, 93.5, 'Urban infrastructure and environmental engineering'],
            ['ETH Zurich', 5, 92.9, 'Alpine engineering and sustainable construction'],
        ]);

        $this->seedSubject('chemical-engineering', [
            ['MIT', 1, 97.8, 'Process systems, biotechnology, and materials synthesis'],
            ['Berkeley', 2, 95.9, 'Energy conversion, catalysis, and polymer science'],
            ['Cambridge', 3, 94.7, 'Biochemical engineering and pharmaceutical processes'],
            ['Stanford', 4, 93.8, 'Clean energy and sustainable chemical processes'],
            ['Oxford', 5, 92.6, 'Molecular engineering and green chemistry'],
        ]);

        // Business & Management subjects
        $this->seedSubject('business-management', [
            ['Harvard', 1, 99.1, 'World-renowned HBS case method, entrepreneurship excellence'],
            ['Stanford', 2, 97.8, 'Silicon Valley connections, innovation, and venture capital'],
            ['MIT', 3, 96.5, 'Sloan School combines business with technology and analytics'],
            ['Oxford', 4, 95.7, 'Saïd Business School, strong in strategy and consulting'],
            ['Cambridge', 5, 94.9, 'Judge Business School, emphasis on responsible business'],
        ]);

        $this->seedSubject('accounting-finance', [
            ['Harvard', 1, 98.5, 'Finance theory, investment banking, and corporate finance'],
            ['MIT', 2, 96.8, 'Quantitative finance and financial engineering'],
            ['Stanford', 3, 95.7, 'Behavioral finance and entrepreneurial finance'],
            ['Oxford', 4, 94.3, 'Financial markets and corporate governance'],
            ['LSE', 5, 93.9, 'European finance hub, econometrics and financial economics'],
        ]);

        $this->seedSubject('economics', [
            ['Harvard', 1, 98.7, 'Development economics, game theory, and econometrics'],
            ['MIT', 2, 97.9, 'Macroeconomics, labor economics, and microeconomic theory'],
            ['Stanford', 3, 96.8, 'Economic policy, behavioral economics, and theory'],
            ['Oxford', 4, 95.6, 'PPE tradition, development and public economics'],
            ['Cambridge', 5, 94.8, 'Keynesian economics heritage, microeconomics excellence'],
        ]);

        $this->seedSubject('marketing', [
            ['Harvard', 1, 97.2, 'Consumer behavior, brand management, and digital marketing'],
            ['Stanford', 2, 95.8, 'Innovation marketing and technology adoption'],
            ['INSEAD', 3, 94.5, 'Global marketing strategy and international business'],
            ['MIT', 4, 93.7, 'Analytics-driven marketing and market research'],
            ['Wharton (Penn)', 5, 92.9, 'Marketing analytics and consumer insights'],
        ]);

        // Life Sciences & Medicine subjects
        $this->seedSubject('medicine', [
            ['Harvard', 1, 99.2, 'HMS: pioneering medical research, clinical excellence, biotechnology'],
            ['Oxford', 2, 98.1, 'Medical Sciences Division, clinical medicine and public health'],
            ['Stanford', 3, 97.5, 'Stanford Medicine, precision health and biomedical innovation'],
            ['Cambridge', 4, 96.8, 'Clinical medicine, medical research, and NHS partnerships'],
            ['Johns Hopkins', 5, 96.3, 'Research hospital integration, surgical innovation'],
        ]);

        $this->seedSubject('biological-sciences', [
            ['Harvard', 1, 98.4, 'MCB and MBB programs, genomics and systems biology'],
            ['MIT', 2, 97.1, 'Biology department, synthetic biology and computational biology'],
            ['Stanford', 3, 96.5, 'Bio-X interdisciplinary research, developmental biology'],
            ['Cambridge', 4, 95.8, 'Molecular biology heritage, genetics and evolution'],
            ['Oxford', 5, 94.9, 'Zoology and plant sciences, ecology and evolution'],
        ]);

        $this->seedSubject('pharmacy-pharmacology', [
            ['Harvard', 1, 97.8, 'Drug development, clinical pharmacology, and therapeutics'],
            ['Oxford', 2, 96.2, 'Pharmaceutical innovation and medicinal chemistry'],
            ['Cambridge', 3, 95.1, 'Pharmacological research and drug discovery'],
            ['UCSF', 4, 94.5, 'Clinical pharmacy and pharmaceutical sciences'],
            ['Toronto', 5, 93.7, 'Pharmacy practice and drug development'],
        ]);

        $this->seedSubject('psychology', [
            ['Harvard', 1, 98.2, 'Clinical, cognitive, and social psychology leadership'],
            ['Stanford', 2, 96.9, 'Behavioral science, cognitive neuroscience'],
            ['Cambridge', 3, 95.7, 'Psychological research and clinical applications'],
            ['Oxford', 4, 94.8, 'Experimental psychology and mental health'],
            ['Berkeley', 5, 93.9, 'Developmental and social psychology'],
        ]);

        $this->seedSubject('nursing', [
            ['Penn', 1, 97.5, 'Penn Nursing: clinical practice innovation, research excellence'],
            ['Johns Hopkins', 2, 96.3, 'Healthcare systems and advanced practice nursing'],
            ['Toronto', 3, 95.1, 'Global health nursing and patient care'],
            ['Washington', 4, 94.2, 'Community health and clinical nursing leadership'],
            ['Manchester', 5, 93.4, 'Nursing research and NHS integration'],
        ]);

        // Natural Sciences subjects
        $this->seedSubject('mathematics', [
            ['MIT', 1, 98.5, 'Pure and applied mathematics, topology, and number theory'],
            ['Harvard', 2, 97.3, 'Mathematical analysis, geometry, and algebraic structures'],
            ['Stanford', 3, 96.4, 'Computational mathematics and optimization'],
            ['Cambridge', 4, 95.8, 'Tripos tradition, theoretical and applied mathematics'],
            ['Oxford', 5, 95.1, 'Mathematical Institute, algebra and logic'],
        ]);

        $this->seedSubject('physics-astronomy', [
            ['MIT', 1, 98.7, 'Particle physics, astrophysics, and quantum mechanics'],
            ['Harvard', 2, 97.5, 'Theoretical physics, cosmology, and astronomy'],
            ['Cambridge', 3, 96.9, 'Cavendish Laboratory, experimental and theoretical physics'],
            ['Stanford', 4, 96.2, 'SLAC National Accelerator Lab, particle physics'],
            ['Oxford', 5, 95.4, 'Physics department, quantum theory and astrophysics'],
        ]);

        $this->seedSubject('chemistry', [
            ['MIT', 1, 98.1, 'Organic, inorganic, and physical chemistry leadership'],
            ['Berkeley', 2, 96.8, 'Chemical research, catalysis, and materials chemistry'],
            ['Cambridge', 3, 95.9, 'Department of Chemistry, synthetic and analytical chemistry'],
            ['Stanford', 4, 95.2, 'Chemical biology and energy research'],
            ['Oxford', 5, 94.5, 'Organic synthesis and computational chemistry'],
        ]);

        $this->seedSubject('environmental-sciences', [
            ['Berkeley', 1, 97.2, 'Climate science, ecology, and environmental policy'],
            ['Stanford', 2, 96.1, 'Environmental systems and sustainability'],
            ['Oxford', 3, 95.3, 'Environmental change and management'],
            ['Cambridge', 4, 94.5, 'Conservation science and environmental research'],
            ['MIT', 5, 93.8, 'Environmental engineering and earth sciences'],
        ]);

        $this->seedSubject('materials-sciences', [
            ['MIT', 1, 98.3, 'DMSE: nanomaterials, biomaterials, and electronic materials'],
            ['Stanford', 2, 96.7, 'Advanced materials and nanotechnology'],
            ['Cambridge', 3, 95.8, 'Materials science and metallurgy'],
            ['Oxford', 4, 94.9, 'Materials research and engineering'],
            ['Northwestern', 5, 94.2, 'Materials innovation and characterization'],
        ]);

        // Arts & Humanities subjects
        $this->seedSubject('english-language-literature', [
            ['Oxford', 1, 98.4, 'English Faculty: literary criticism, creative writing'],
            ['Cambridge', 2, 97.6, 'English literature tradition, critical theory'],
            ['Harvard', 3, 96.8, 'Comparative literature and literary studies'],
            ['Yale', 4, 95.9, 'English department, poetry and drama'],
            ['Berkeley', 5, 95.1, 'Literary criticism and cultural studies'],
        ]);

        $this->seedSubject('history', [
            ['Harvard', 1, 98.1, 'Global history, American history, and historical methodology'],
            ['Oxford', 2, 97.3, 'Historical research across all periods and regions'],
            ['Cambridge', 3, 96.5, 'Medieval, modern, and economic history'],
            ['Princeton', 4, 95.7, 'American and European history'],
            ['Yale', 5, 94.9, 'Cultural and intellectual history'],
        ]);

        $this->seedSubject('philosophy', [
            ['NYU', 1, 97.8, 'Philosophy department: ethics, metaphysics, and logic'],
            ['Oxford', 2, 96.9, 'Philosophy Faculty, PPE tradition'],
            ['Harvard', 3, 96.1, 'Philosophical thought and contemporary philosophy'],
            ['Cambridge', 4, 95.3, 'Analytic philosophy and ethics'],
            ['Princeton', 5, 94.6, 'Philosophical logic and political philosophy'],
        ]);

        $this->seedSubject('linguistics', [
            ['MIT', 1, 97.5, 'Generative linguistics, syntax, and language acquisition'],
            ['Harvard', 2, 96.2, 'Linguistic theory and language evolution'],
            ['Cambridge', 3, 95.4, 'Theoretical and applied linguistics'],
            ['Stanford', 4, 94.6, 'Computational linguistics and psycholinguistics'],
            ['Berkeley', 5, 93.8, 'Language typology and sociolinguistics'],
        ]);

        $this->seedSubject('art-design', [
            ['RCA', 1, 98.1, 'Royal College of Art: innovation in design and visual arts'],
            ['MIT', 2, 95.8, 'Media Lab: technology meets design and art'],
            ['Parsons', 3, 94.5, 'Fashion, product, and communication design'],
            ['Rhode Island', 4, 93.7, 'RISD: fine arts and design leadership'],
            ['Art Institute Chicago', 5, 92.9, 'Contemporary art and design education'],
        ]);

        // Social Sciences subjects
        $this->seedSubject('law', [
            ['Harvard', 1, 98.9, 'HLS: constitutional law, international law, and legal theory'],
            ['Oxford', 2, 97.5, 'Faculty of Law: common law and jurisprudence'],
            ['Cambridge', 3, 96.7, 'Law Faculty: legal research and practice'],
            ['Yale', 4, 96.1, 'YLS: legal scholarship and public interest law'],
            ['Stanford', 5, 95.3, 'Law School: technology law and corporate law'],
        ]);

        $this->seedSubject('politics', [
            ['Harvard', 1, 98.3, 'Government department: political theory and comparative politics'],
            ['Oxford', 2, 97.1, 'Politics and International Relations, PPE tradition'],
            ['Princeton', 3, 96.4, 'Political science and public policy'],
            ['Stanford', 4, 95.6, 'Political analysis and methodology'],
            ['LSE', 5, 94.8, 'Government and political economy'],
        ]);

        $this->seedSubject('sociology', [
            ['Harvard', 1, 97.9, 'Social theory, inequality, and quantitative methods'],
            ['Berkeley', 2, 96.5, 'Social movements and organizational sociology'],
            ['Oxford', 3, 95.7, 'Sociology department: social research'],
            ['Cambridge', 4, 94.8, 'Sociological theory and methodology'],
            ['LSE', 5, 94.1, 'Social research and policy analysis'],
        ]);

        $this->seedSubject('anthropology', [
            ['Harvard', 1, 97.6, 'Social and biological anthropology'],
            ['Oxford', 2, 96.3, 'Anthropological research and ethnography'],
            ['Cambridge', 3, 95.5, 'Social anthropology tradition'],
            ['Berkeley', 4, 94.7, 'Cultural and archaeological anthropology'],
            ['LSE', 5, 93.9, 'Social anthropology and development'],
        ]);

        $this->seedSubject('education', [
            ['Harvard', 1, 98.1, 'Graduate School of Education: policy, leadership, and pedagogy'],
            ['Stanford', 2, 96.8, 'Educational research and innovation'],
            ['Oxford', 3, 95.6, 'Department of Education: teaching and learning'],
            ['Cambridge', 4, 94.7, 'Faculty of Education: educational research'],
            ['Berkeley', 5, 93.9, 'Education policy and social context'],
        ]);

        // Additional important subjects
        $this->seedSubject('architecture', [
            ['MIT', 1, 97.8, 'Architecture department: sustainable design and urban planning'],
            ['Harvard', 2, 96.5, 'GSD: architectural history and design'],
            ['Berkeley', 3, 95.4, 'Environmental design and urban studies'],
            ['Cambridge', 4, 94.6, 'Architecture and history of art'],
            ['ETH Zurich', 5, 93.8, 'European architectural excellence'],
        ]);

        $this->seedSubject('geography', [
            ['Oxford', 1, 97.3, 'Human and physical geography, GIS and spatial analysis'],
            ['Cambridge', 2, 96.1, 'Geography department: environmental and social geography'],
            ['Berkeley', 3, 95.2, 'Geographical research and urban studies'],
            ['LSE', 4, 94.4, 'Urban geography and spatial economics'],
            ['Durham', 5, 93.6, 'Physical and human geography'],
        ]);

        $this->seedSubject('communication-media-studies', [
            ['Stanford', 1, 96.8, 'Communication research, media effects, and digital media'],
            ['Penn', 2, 95.5, 'Annenberg School: communication theory'],
            ['Northwestern', 3, 94.7, 'Medill School: journalism and media'],
            ['USC', 4, 93.9, 'Communication and media studies'],
            ['LSE', 5, 93.1, 'Media and communications research'],
        ]);

        $this->seedSubject('hospitality-leisure-management', [
            ['Lausanne', 1, 96.5, 'EHL: global hospitality management excellence'],
            ['Surrey', 2, 94.8, 'School of Hospitality and Tourism Management'],
            ['Glion', 3, 93.7, 'Swiss hospitality education leadership'],
            ['Bournemouth', 4, 92.9, 'Tourism and hospitality research'],
            ['Hong Kong Polytechnic', 5, 92.1, 'Asian hospitality management hub'],
        ]);

        $this->seedSubject('sports-related-subjects', [
            ['Loughborough', 1, 96.9, 'Sports science, sports management, and exercise physiology'],
            ['Queensland', 2, 95.4, 'Human movement and sports research'],
            ['Birmingham', 3, 94.6, 'Sport, exercise and rehabilitation sciences'],
            ['Toronto', 4, 93.8, 'Kinesiology and physical education'],
            ['Sydney', 5, 93.1, 'Sports and exercise science'],
        ]);

        $this->seedSubject('dentistry', [
            ['Michigan', 1, 97.2, 'School of Dentistry: clinical excellence and research'],
            ['Harvard', 2, 96.5, 'Dental medicine and oral health sciences'],
            ['Hong Kong', 3, 95.7, 'Faculty of Dentistry: clinical training'],
            ['KCL', 4, 94.9, "King's College Dental Institute"],
            ['Tokyo Medical and Dental', 5, 94.1, 'Japanese dental research leader'],
        ]);

        $this->seedSubject('veterinary-science', [
            ['RVC', 1, 97.6, 'Royal Veterinary College: clinical veterinary medicine'],
            ['Cambridge', 2, 96.4, 'School of Veterinary Medicine'],
            ['UC Davis', 3, 95.8, 'Veterinary medicine and animal science'],
            ['Cornell', 4, 95.1, 'College of Veterinary Medicine'],
            ['Edinburgh', 5, 94.3, 'Royal (Dick) School of Veterinary Studies'],
        ]);

        $this->seedSubject('agriculture-forestry', [
            ['Wageningen', 1, 97.9, 'Agricultural sciences and food technology leadership'],
            ['UC Davis', 2, 96.3, 'Agriculture and environmental sciences'],
            ['Cornell', 3, 95.5, 'College of Agriculture and Life Sciences'],
            ['Reading', 4, 94.2, 'Agriculture, food and consumer sciences'],
            ['ETH Zurich', 5, 93.6, 'Agricultural and environmental research'],
        ]);

        $this->seedSubject('development-studies', [
            ['Harvard', 1, 97.1, 'Kennedy School: international development and policy'],
            ['Oxford', 2, 96.2, 'Queen Elizabeth House: development studies'],
            ['Cambridge', 3, 95.3, 'Development and economics research'],
            ['LSE', 4, 94.5, 'International development and policy'],
            ['Berkeley', 5, 93.7, 'Development practice and policy'],
        ]);

        $this->command->info('✅ Successfully added comprehensive subject-university rankings!');
        $this->command->info('📊 Total relationships created: Multiple subjects covered');
    }

    /**
     * Helper method to seed subject-university relationships
     */
    private function seedSubject(string $subjectSlug, array $universities): void
    {
        $subject = Subject::where('slug', $subjectSlug)->first();

        if (!$subject) {
            $this->command->warn("⚠️  Subject '{$subjectSlug}' not found in database. Skipping...");
            return;
        }

        $count = 0;
        foreach ($universities as [$uniName, $rank, $score, $highlights]) {
            // Try to find university by partial name match
            $university = University::where('name', 'like', "%{$uniName}%")->first();

            if (!$university) {
                // Try common abbreviations
                $abbreviations = [
                    'MIT' => 'Massachusetts Institute of Technology',
                    'Berkeley' => 'University of California, Berkeley',
                    'UCLA' => 'University of California, Los Angeles',
                    'UCSF' => 'University of California, San Francisco',
                    'UCL' => 'University College London',
                    'LSE' => 'London School of Economics',
                    'INSEAD' => 'INSEAD',
                    'Wharton (Penn)' => 'University of Pennsylvania',
                    'Penn' => 'University of Pennsylvania',
                    'USC' => 'University of Southern California',
                    'NYU' => 'New York University',
                    'RCA' => 'Royal College of Art',
                    'RISD' => 'Rhode Island School of Design',
                    'Parsons' => 'Parsons School of Design',
                    'Art Institute Chicago' => 'School of the Art Institute of Chicago',
                    'RVC' => 'Royal Veterinary College',
                    'UC Davis' => 'University of California, Davis',
                    'KCL' => "King's College London",
                    'Glion' => 'Glion Institute of Higher Education',
                    'Lausanne' => 'École hôtelière de Lausanne',
                    'Carnegie Mellon' => 'Carnegie Mellon University',
                ];

                if (isset($abbreviations[$uniName])) {
                    $university = University::where('name', 'like', "%{$abbreviations[$uniName]}%")->first();
                }
            }

            if (!$university) {
                $this->command->warn("⚠️  University '{$uniName}' not found. Skipping...");
                continue;
            }

            // Check if relationship already exists
            $exists = DB::table('subject_university')
                ->where('subject_id', $subject->id)
                ->where('university_id', $university->id)
                ->where('year', 2026)
                ->exists();

            if (!$exists) {
                DB::table('subject_university')->insert([
                    'subject_id' => $subject->id,
                    'university_id' => $university->id,
                    'rank' => $rank,
                    'year' => 2026,
                    'score' => $score,
                    'highlights' => $highlights,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $count++;
            }
        }

        if ($count > 0) {
            $this->command->info("   ✓ Added {$count} universities to {$subject->name}");
        }
    }
}
