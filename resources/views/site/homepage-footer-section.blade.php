{{-- Homepage Footer Section --}}
{{-- Add your footer section content here --}}


@php
$faq = [
    [
        'question' => 'What is IFTA?',
        'answer' => 'IFTA (The International Fuel Tax Agreement) is an agreement between all US states (except Alaska and Hawaii) and Canadian provinces and territories (except Yukon Territory, Northwest Territory and Nunavut), to simplify the reporting of fuel use by motor carriers that operate in more than one jurisdiction.'
    ],
    [
        'question' => 'What is IFTA fuel tax report?',
        'answer' => 'IFTA fuel tax report is a report for calculating fuel taxes due or refund that should be filed quarterly. This report is used to redistribute taxes from collecting states to states that it is due.'
    ],
    [
        'question' => 'What are non-IFTA miles?',
        'answer' => 'Non-IFTA jurisdictions are the following: Alaska, Hawaii, District of Columbia (US); Yukon Territory, Northwest Territory, Nunavut (Canadian territories); and all of Mexico. All miles driven in these locations are considered to be Non-IFTA miles and should be reported as \'Non-IFTA\' miles in the IFTA report. So you will not have to pay IFTA fuel tax for these miles.'
    ],
    [
        'question' => 'Do I need IFTA?',
        'answer' => 'You do need IFTA if you operate your qualified motor vehicle for business purposes in at least two IFTA jurisdictions and your vehicle meets any of the following criteria:<br><ul><li>weighs over 26,000 pounds,</li><li>or has three or more axles on the power unit,</li><li>or (less applicably to truck companies) is a bus that can carry at least 20 passengers.</li></ul>'
    ],
    [
        'question' => 'Which vehicles are not qualified for IFTA?',
        'answer' => 'A recreational vehicle such as a motor home or a pickup with a camper is not considered a qualified motor vehicle when an individual uses it exclusively for personal pleasure.'
    ],
    [
        'question' => 'How to get IFTA license?',
        'answer' => '<ol><li>You need to apply for your IFTA license with the licensing agency in your base jurisdiction (it is the location where you have your business with a physical address).</li><li>Fill out the application online (or paper application in the office of your state\'s licensing authority).</li><li>Submit your application along with the application for the decals and the fees. You will need a set of two decals (they cost approximately 10 dollars).</li><li>They will send you the IFTA two decals (stickers) to put on your truck. You need two decals for each qualifying vehicle you operate.</li><li>Place these decals on the driver\'s and passenger\'s side lower rear exterior of the cab.</li><li>You are all set! Please remember that the decals are valid for one year and then you will need to apply for a new set.</li></ol>'
    ],
    [
        'question' => 'How much does IFTA sticker cost?',
        'answer' => 'The cost for IFTA sticker varies from state to state, but typically it is around $10.'
    ],
    [
        'question' => 'What states are IFTA jurdictions?',
        'answer' => 'IFTA jurdictions are all US states except Alaska, Hawaii and the District of Columbia and Canadian provinces and territories except Yukon Territory, Northwest Territory and Nunavut.'
    ],
    [
        'question' => 'What states are not part of IFTA?',
        'answer' => 'Alaska, Hawaii and the District of Columbia in the US and Yukon Territory, Northwest Territory and Nunavut in Canada are not part of IFTA.'
    ],
    [
        'question' => 'What are requirements for IFTA?',
        'answer' => 'You need to operate your qualified motor vehicle for business purposes in at least two IFTA jurisdictions and your vehicle meets any of the following criteria:<br><ul><li>weighs over 26,000 pounds,</li><li>or has three or more axles on the power unit,</li><li>or (less applicably to truck companies) is a bus that can carry at least 20 passengers.</li></ul>'
    ],
    [
        'question' => 'How do i track my IFTA miles?',
        'answer' => '<ul><li>Keep a notebook and write the odometer when you cross state borders.</li><li>Use a GPS or other device that records state by state miles per quarter.</li><li>Use routing software that tracks state miles.</li></ul>'
    ],
    [
        'question' => 'What is IFTA reporting period?',
        'answer' => 'IFTA reporting period is each quarter. Here is the list of IFTA report due dates for each reporting period:<br><ul><li>1st quarter is from January to March, due date for the report is April 30.</li><li>2nd quarter is from April to June, due date is July 31.</li><li>3rd quarter is from July to September, due date is October 31.</li><li>4th quarter is from October to December, due date is January 31.</li></ul>'
    ],
    [
        'question' => 'How does the IFTA tax work?',
        'answer' => 'You file the quarterly report with all the miles driven and fuel used for all states. Then the program redistributes paid taxes from collecting states to states that it is due and calculates tax due or tax refund.'
    ],
    [
        'question' => 'How to calculate your quarterly IFTA report?',
        'answer' => 'The easiest way is to use special software (like <a href="https://ifta-calculator.com" target="_blank">IFTA calculator</a>) for calculating your quarterly IFTA report. You should provide all your trips (start and end location) and all purchased fuel during this period, all the rest the IFTA calculator will do itself and provide you with the numbers for the report.'
    ],
    [
        'question' => 'What is the best way to record miles per state?',
        'answer' => 'The best and easiest way is to use software where you can put the first and the last stop of your trip and the software calculates fuel per states itself.'
    ],
    [
        'question' => 'IFTA reporting mileage calculator',
        'answer' => 'There are a lot of IFTA calculators online, but some of them are expensive, some are hard to use and not user-friendly at all. IFTA calculator at <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a> is a free and easy online calculator, you need to provide only information about your stops and your fuel purchases. No notes, no frantic manual counting, no regular checking odometer - just your trips and used fuel.'
    ],
    [
        'question' => 'How to run an IFTA report?',
        'answer' => 'To run an IFTA report you need special software where you provide information about your trips and used fuel for the necessary quarter. The software calculates data necessary for the report - distributes tax between states and provides the sum that is due to pay or refund.'
    ],
    [
        'question' => 'What are IFTA tax rates?',
        'answer' => 'IFTA tax rates can be viewed at <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>. But actually you don\'t need to know the exact rates for each state and calculate sums manually. All you need to know is information about your trips and purchased fuel and the software applies all the state rates automatically.'
    ],
    [
        'question' => 'IFTA reporting online',
        'answer' => 'To be able to report IFTA online you need to have an account with the taxation or revenue agency in the state where your business is based.<br>To open an account you need to do the following steps:<br><ul><li>Find the IFTA website for your state.</li><li>Create an account. It allows you not only to pay taxes, but also manage your licence information and apply for new decals. Please note that you should create your account in advance because in some states in can take time to verify your provided information.</li><li>Fill out the application online. You will need to provide information about your total mileage for each jurisdiction and location and price of purchased fuel. If the tax rate in a jurisdiction is higher than the fuel tax in your base jurisdiction, you\'ll have a credit. If the tax rate is lower, you\'ll owe taxes. The system will count these amounts to determine whether you are owed a refund or have a tax payment due.</li><li>If you have a tax payment due, you can pay your taxes online.</li></ul>'
    ],
    [
        'question' => 'Who pays IFTA tax?',
        'answer' => 'It is necessary to pay IFTA tax if you operate your qualified motor vehicle for business purposes in at least two IFTA jurisdictions and your vehicle meets any of the following criteria: weighs over 26,000 pounds, or has three or more axles on the power unit.'
    ],
    [
        'question' => 'How much is the tax on diesel fuel?',
        'answer' => 'The United States federal excise tax on gasoline is 18.4 cents per gallon and 24.4 cents per gallon for diesel fuel. Exact tax rates for definite quarters can be viewed online at <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>.'
    ],
    [
        'question' => 'IFTA state mileage calculator',
        'answer' => 'Easy and free state mileage calculator is <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a>. You need to provide only information about your stops and your fuel purchases.'
    ],
    [
        'question' => 'What does IFTA cost?',
        'answer' => 'The state\'s registration fee for your apportioned plate will vary depending on your base state, gross vehicle weight, and states you wish to register. Typically the state fees for an 80,000 pound vehicle running all 48 lower states is between $1500 and $2000, but this could vary depending on you base state.'
    ]
];
@endphp





<div class="front-page__rates-link">
        <a href="/rates/">View IFTA Rates</a>
      </div>

      <div class="front-page__faq">
        <h4>Frequently asked questions</h4>

        @foreach($faq as $q)
        <div class="front-page__faq-item">
          <h6>{{ $q['question'] }}</h6>
          <div>{!! $q['answer'] !!}</div>
        </div>
        @endforeach
      </div>
