{{-- Homepage Footer Section --}}
{{-- Add your footer section content here --}}


@php
$faq = [
    'en'=>[
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
    ],
    'es' => [
        [
            'question' => '¿Qué es IFTA?',
            'answer' => 'IFTA (El Acuerdo Internacional de Impuestos sobre Combustibles) es un acuerdo entre todos los estados de EE.UU. (excepto Alaska y Hawaii) y las provincias y territorios canadienses (excepto el Territorio de Yukon, Territorios del Noroeste y Nunavut), para simplificar el reporte del uso de combustible por transportistas motorizados que operan en más de una jurisdicción.'
        ],
        [
            'question' => '¿Qué es el reporte de impuestos sobre combustible IFTA?',
            'answer' => 'El reporte de impuestos sobre combustible IFTA es un reporte para calcular los impuestos sobre combustible adeudados o reembolsos que deben presentarse trimestralmente. Este reporte se utiliza para redistribuir los impuestos de los estados recaudadores a los estados a los que se debe.'
        ],
        [
            'question' => '¿Qué son las millas no-IFTA?',
            'answer' => 'Las jurisdicciones no-IFTA son las siguientes: Alaska, Hawaii, Distrito de Columbia (EE.UU.); Territorio de Yukon, Territorios del Noroeste, Nunavut (territorios canadienses); y todo México. Todas las millas conducidas en estas ubicaciones se consideran millas no-IFTA y deben reportarse como millas \'no-IFTA\' en el reporte IFTA. Por lo tanto, no tendrás que pagar impuestos sobre combustible IFTA por estas millas.'
        ],
        [
            'question' => '¿Necesito IFTA?',
            'answer' => 'Sí necesitas IFTA si operas tu vehículo motor calificado para propósitos comerciales en al menos dos jurisdicciones IFTA y tu vehículo cumple con cualquiera de los siguientes criterios:<br><ul><li>pesa más de 26,000 libras,</li><li>o tiene tres o más ejes en la unidad motriz,</li><li>o (menos aplicable a empresas de camiones) es un autobús que puede llevar al menos 20 pasajeros.</li></ul>'
        ],
        [
            'question' => '¿Qué vehículos no califican para IFTA?',
            'answer' => 'Un vehículo recreativo como una casa rodante o una camioneta con un camper no se considera un vehículo motor calificado cuando un individuo lo usa exclusivamente para placer personal.'
        ],
        [
            'question' => '¿Cómo obtener licencia IFTA?',
            'answer' => '<ol><li>Necesitas solicitar tu licencia IFTA con la agencia de licencias en tu jurisdicción base (es la ubicación donde tienes tu negocio con una dirección física).</li><li>Llena la solicitud en línea (o solicitud en papel en la oficina de la autoridad de licencias de tu estado).</li><li>Envía tu solicitud junto con la solicitud para las calcomanías y las tarifas. Necesitarás un conjunto de dos calcomanías (cuestan aproximadamente 10 dólares).</li><li>Te enviarán las dos calcomanías IFTA (pegatinas) para poner en tu camión. Necesitas dos calcomanías para cada vehículo calificado que operes.</li><li>Coloca estas calcomanías en el lado inferior posterior exterior de la cabina del conductor y del pasajero.</li><li>¡Ya estás listo! Recuerda que las calcomanías son válidas por un año y luego necesitarás solicitar un nuevo conjunto.</li></ol>'
        ],
        [
            'question' => '¿Cuánto cuesta la calcomanía IFTA?',
            'answer' => 'El costo de la calcomanía IFTA varía de estado a estado, pero típicamente es alrededor de $10.'
        ],
        [
            'question' => '¿Qué estados son jurisdicciones IFTA?',
            'answer' => 'Las jurisdicciones IFTA son todos los estados de EE.UU. excepto Alaska, Hawaii y el Distrito de Columbia y las provincias y territorios canadienses excepto el Territorio de Yukon, Territorios del Noroeste y Nunavut.'
        ],
        [
            'question' => '¿Qué estados no son parte de IFTA?',
            'answer' => 'Alaska, Hawaii y el Distrito de Columbia en EE.UU. y el Territorio de Yukon, Territorios del Noroeste y Nunavut en Canadá no son parte de IFTA.'
        ],
        [
            'question' => '¿Cuáles son los requisitos para IFTA?',
            'answer' => 'Necesitas operar tu vehículo motor calificado para propósitos comerciales en al menos dos jurisdicciones IFTA y tu vehículo cumple con cualquiera de los siguientes criterios:<br><ul><li>pesa más de 26,000 libras,</li><li>o tiene tres o más ejes en la unidad motriz,</li><li>o (menos aplicable a empresas de camiones) es un autobús que puede llevar al menos 20 pasajeros.</li></ul>'
        ],
        [
            'question' => '¿Cómo rastreo mis millas IFTA?',
            'answer' => '<ul><li>Mantén un cuaderno y escribe el odómetro cuando cruces las fronteras estatales.</li><li>Usa un GPS u otro dispositivo que registre millas estado por estado por trimestre.</li><li>Usa software de enrutamiento que rastree millas estatales.</li></ul>'
        ],
        [
            'question' => '¿Cuál es el período de reporte IFTA?',
            'answer' => 'El período de reporte IFTA es cada trimestre. Aquí está la lista de fechas de vencimiento del reporte IFTA para cada período de reporte:<br><ul><li>1er trimestre es de enero a marzo, fecha de vencimiento del reporte es 30 de abril.</li><li>2do trimestre es de abril a junio, fecha de vencimiento es 31 de julio.</li><li>3er trimestre es de julio a septiembre, fecha de vencimiento es 31 de octubre.</li><li>4to trimestre es de octubre a diciembre, fecha de vencimiento es 31 de enero.</li></ul>'
        ],
        [
            'question' => '¿Cómo funciona el impuesto IFTA?',
            'answer' => 'Presentas el reporte trimestral con todas las millas conducidas y combustible usado para todos los estados. Luego el programa redistribuye los impuestos pagados de los estados recaudadores a los estados a los que se debe y calcula el impuesto adeudado o reembolso de impuestos.'
        ],
        [
            'question' => '¿Cómo calcular tu reporte trimestral IFTA?',
            'answer' => 'La forma más fácil es usar software especial (como <a href="https://ifta-calculator.com" target="_blank">calculadora IFTA</a>) para calcular tu reporte trimestral IFTA. Debes proporcionar todos tus viajes (ubicación de inicio y fin) y todo el combustible comprado durante este período, todo lo demás la calculadora IFTA lo hará por sí misma y te proporcionará los números para el reporte.'
        ],
        [
            'question' => '¿Cuál es la mejor manera de registrar millas por estado?',
            'answer' => 'La mejor y más fácil manera es usar software donde puedes poner la primera y última parada de tu viaje y el software calcula el combustible por estados por sí mismo.'
        ],
        [
            'question' => 'Calculadora de millas para reportes IFTA',
            'answer' => 'Hay muchas calculadoras IFTA en línea, algunas son caras, algunas son difíciles de usar y no son amigables para el usuario en absoluto. La calculadora IFTA en <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a> es una calculadora en línea gratuita y fácil, solo necesitas proporcionar información sobre tus paradas y tus compras de combustible. Sin notas, sin conteo manual frenético, sin verificación regular del odómetro - solo tus viajes y combustible usado.'
        ],
        [
            'question' => '¿Cómo ejecutar un reporte IFTA?',
            'answer' => 'Para ejecutar un reporte IFTA necesitas software especial donde proporcionas información sobre tus viajes y combustible usado para el trimestre necesario. El software calcula los datos necesarios para el reporte - distribuye impuestos entre estados y proporciona la suma que se debe pagar o reembolsar.'
        ],
        [
            'question' => '¿Cuáles son las tasas de impuestos IFTA?',
            'answer' => 'Las tasas de impuestos IFTA se pueden ver en <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>. Pero en realidad no necesitas conocer las tasas exactas para cada estado y calcular sumas manualmente. Todo lo que necesitas saber es información sobre tus viajes y combustible comprado y el software aplica todas las tasas estatales automáticamente.'
        ],
        [
            'question' => 'Reportes IFTA en línea',
            'answer' => 'Para poder reportar IFTA en línea necesitas tener una cuenta con la agencia de impuestos o ingresos en el estado donde está basado tu negocio.<br>Para abrir una cuenta necesitas hacer los siguientes pasos:<br><ul><li>Encuentra el sitio web IFTA para tu estado.</li><li>Crea una cuenta. Te permite no solo pagar impuestos, sino también administrar la información de tu licencia y solicitar nuevas calcomanías. Ten en cuenta que debes crear tu cuenta con anticipación porque en algunos estados puede tomar tiempo verificar la información que proporcionaste.</li><li>Llena la solicitud en línea. Necesitarás proporcionar información sobre tu kilometraje total para cada jurisdicción y ubicación y precio del combustible comprado. Si la tasa de impuestos en una jurisdicción es más alta que el impuesto sobre combustible en tu jurisdicción base, tendrás un crédito. Si la tasa de impuestos es más baja, deberás impuestos. El sistema contará estas cantidades para determinar si se te debe un reembolso o tienes un pago de impuestos adeudado.</li><li>Si tienes un pago de impuestos adeudado, puedes pagar tus impuestos en línea.</li></ul>'
        ],
        [
            'question' => '¿Quién paga impuestos IFTA?',
            'answer' => 'Es necesario pagar impuestos IFTA si operas tu vehículo motor calificado para propósitos comerciales en al menos dos jurisdicciones IFTA y tu vehículo cumple con cualquiera de los siguientes criterios: pesa más de 26,000 libras, o tiene tres o más ejes en la unidad motriz.'
        ],
        [
            'question' => '¿Cuánto es el impuesto sobre combustible diesel?',
            'answer' => 'El impuesto federal de excisión de EE.UU. sobre gasolina es 18.4 centavos por galón y 24.4 centavos por galón para combustible diesel. Las tasas exactas de impuestos para trimestres definidos se pueden ver en línea en <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>.'
        ],
        [
            'question' => 'Calculadora de millas estatales IFTA',
            'answer' => 'La calculadora de millas estatales fácil y gratuita es <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a>. Solo necesitas proporcionar información sobre tus paradas y tus compras de combustible.'
        ],
        [
            'question' => '¿Cuánto cuesta IFTA?',
            'answer' => 'La tarifa de registro estatal para tu placa proporcional variará dependiendo de tu estado base, peso bruto del vehículo y estados en los que desees registrarte. Típicamente las tarifas estatales para un vehículo de 80,000 libras corriendo en los 48 estados inferiores es entre $1500 y $2000, pero esto podría variar dependiendo de tu estado base.'
        ]
    ],
    'ru' => [
        [
            'question' => 'Что такое IFTA?',
            'answer' => 'IFTA (Международное соглашение о топливном налоге) - это соглашение между всеми штатами США (кроме Аляски и Гавайев) и канадскими провинциями и территориями (кроме территории Юкон, Северо-Западных территорий и Нунавута), упрощающее отчетность об использовании топлива перевозчиками, которые работают более чем в одной юрисдикции.'
        ],
        [
            'question' => 'Что такое отчет о топливном налоге IFTA?',
            'answer' => 'Отчет о топливном налоге IFTA - это отчет для расчета причитающихся топливных налогов или возмещений, который должен подаваться ежеквартально. Этот отчет используется для перераспределения налогов от собирающих штатов к штатам, которым они причитаются.'
        ],
        [
            'question' => 'Что такое мили не-IFTA?',
            'answer' => 'Юрисдикции не-IFTA следующие: Аляска, Гавайи, округ Колумбия (США); территория Юкон, Северо-Западные территории, Нунавут (канадские территории); и весь Мексика. Все мили, пройденные в этих местах, считаются милями не-IFTA и должны указываться как мили \'не-IFTA\' в отчете IFTA. Таким образом, вам не придется платить топливный налог IFTA за эти мили.'
        ],
        [
            'question' => 'Нужен ли мне IFTA?',
            'answer' => 'Да, вам нужен IFTA, если вы эксплуатируете ваш квалифицированный моторизованный транспорт для коммерческих целей по крайней мере в двух юрисдикциях IFTA и ваш транспорт соответствует любому из следующих критериев:<br><ul><li>весит более 26,000 фунтов,</li><li>или имеет три или более оси на силовом агрегате,</li><li>или (менее применимо к компаниям грузовиков) это автобус, который может перевозить по крайней мере 20 пассажиров.</li></ul>'
        ],
        [
            'question' => 'Какие транспортные средства не квалифицируются для IFTA?',
            'answer' => 'Рекреационный транспорт, такой как дом на колесах или пикап с кемпером, не считается квалифицированным моторизованным транспортом, когда физическое лицо использует его исключительно для личного удовольствия.'
        ],
        [
            'question' => 'Как получить лицензию IFTA?',
            'answer' => '<ol><li>Вам нужно подать заявку на лицензию IFTA в агентство по лицензированию в вашей базовой юрисдикции (это место, где у вас есть бизнес с физическим адресом).</li><li>Заполните заявку онлайн (или бумажную заявку в офисе лицензирующего органа вашего штата).</li><li>Подайте вашу заявку вместе с заявкой на наклейки и сборы. Вам понадобится набор из двух наклеек (они стоят примерно 10 долларов).</li><li>Они отправят вам две наклейки IFTA (стикеры) для размещения на вашем грузовике. Вам нужны две наклейки для каждого квалифицированного транспорта, которым вы управляете.</li><li>Разместите эти наклейки на нижней задней внешней стороне кабины со стороны водителя и пассажира.</li><li>Вы готовы! Помните, что наклейки действительны в течение одного года, а затем вам нужно будет подать заявку на новый набор.</li></ol>'
        ],
        [
            'question' => 'Сколько стоит наклейка IFTA?',
            'answer' => 'Стоимость наклейки IFTA варьируется от штата к штату, но обычно составляет около $10.'
        ],
        [
            'question' => 'Какие штаты являются юрисдикциями IFTA?',
            'answer' => 'Юрисдикции IFTA - это все штаты США, кроме Аляски, Гавайев и округа Колумбия, и канадские провинции и территории, кроме территории Юкон, Северо-Западных территорий и Нунавута.'
        ],
        [
            'question' => 'Какие штаты не являются частью IFTA?',
            'answer' => 'Аляска, Гавайи и округ Колумбия в США и территория Юкон, Северо-Западные территории и Нунавут в Канаде не являются частью IFTA.'
        ],
        [
            'question' => 'Какие требования для IFTA?',
            'answer' => 'Вам нужно эксплуатировать ваш квалифицированный моторизованный транспорт для коммерческих целей по крайней мере в двух юрисдикциях IFTA, и ваш транспорт соответствует любому из следующих критериев:<br><ul><li>весит более 26,000 фунтов,</li><li>или имеет три или более оси на силовом агрегате,</li><li>или (менее применимо к компаниям грузовиков) это автобус, который может перевозить по крайней мере 20 пассажиров.</li></ul>'
        ],
        [
            'question' => 'Как отслеживать мои мили IFTA?',
            'answer' => '<ul><li>Ведите блокнот и записывайте одометр при пересечении границ штатов.</li><li>Используйте GPS или другое устройство, которое записывает мили по штатам за квартал.</li><li>Используйте программное обеспечение для маршрутизации, которое отслеживает мили по штатам.</li></ul>'
        ],
        [
            'question' => 'Какой период отчетности IFTA?',
            'answer' => 'Период отчетности IFTA - каждый квартал. Вот список сроков подачи отчетов IFTA для каждого отчетного периода:<br><ul><li>1-й квартал с января по март, срок подачи отчета 30 апреля.</li><li>2-й квартал с апреля по июнь, срок подачи 31 июля.</li><li>3-й квартал с июля по сентябрь, срок подачи 31 октября.</li><li>4-й квартал с октября по декабрь, срок подачи 31 января.</li></ul>'
        ],
        [
            'question' => 'Как работает налог IFTA?',
            'answer' => 'Вы подаете квартальный отчет со всеми пройденными милями и использованным топливом для всех штатов. Затем программа перераспределяет уплаченные налоги от собирающих штатов к штатам, которым они причитаются, и рассчитывает причитающийся налог или возмещение налога.'
        ],
        [
            'question' => 'Как рассчитать ваш квартальный отчет IFTA?',
            'answer' => 'Самый простой способ - использовать специальное программное обеспечение (например, <a href="https://ifta-calculator.com" target="_blank">калькулятор IFTA</a>) для расчета вашего квартального отчета IFTA. Вы должны предоставить все ваши поездки (место начала и окончания) и все купленное топливо в течение этого периода, все остальное калькулятор IFTA сделает сам и предоставит вам цифры для отчета.'
        ],
        [
            'question' => 'Какой лучший способ записывать мили по штатам?',
            'answer' => 'Лучший и самый простой способ - использовать программное обеспечение, где вы можете указать первую и последнюю остановку вашей поездки, и программное обеспечение само рассчитывает топливо по штатам.'
        ],
        [
            'question' => 'Калькулятор миль для отчетов IFTA',
            'answer' => 'В интернете много калькуляторов IFTA, некоторые из них дорогие, некоторые сложны в использовании и совсем не удобны для пользователя. Калькулятор IFTA на <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a> - это бесплатный и простой онлайн-калькулятор, вам нужно предоставить только информацию о ваших остановках и покупках топлива. Без заметок, без лихорадочного ручного подсчета, без регулярной проверки одометра - только ваши поездки и использованное топливо.'
        ],
        [
            'question' => 'Как запустить отчет IFTA?',
            'answer' => 'Для запуска отчета IFTA вам нужно специальное программное обеспечение, где вы предоставляете информацию о ваших поездках и использованном топливе за необходимый квартал. Программное обеспечение рассчитывает данные, необходимые для отчета - распределяет налоги между штатами и предоставляет сумму, которую нужно уплатить или возместить.'
        ],
        [
            'question' => 'Какие ставки налогов IFTA?',
            'answer' => 'Ставки налогов IFTA можно посмотреть на <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>. Но на самом деле вам не нужно знать точные ставки для каждого штата и рассчитывать суммы вручную. Все, что вам нужно знать, это информация о ваших поездках и купленном топливе, и программное обеспечение автоматически применяет все ставки штатов.'
        ],
        [
            'question' => 'Отчеты IFTA онлайн',
            'answer' => 'Чтобы иметь возможность подавать отчеты IFTA онлайн, вам нужно иметь аккаунт с агентством по налогообложению или доходам в штате, где базируется ваш бизнес.<br>Для открытия аккаунта вам нужно выполнить следующие шаги:<br><ul><li>Найдите сайт IFTA для вашего штата.</li><li>Создайте аккаунт. Это позволяет не только платить налоги, но и управлять информацией о лицензии и подавать заявки на новые наклейки. Обратите внимание, что вы должны создать свой аккаунт заранее, потому что в некоторых штатах может потребоваться время для проверки предоставленной вами информации.</li><li>Заполните заявку онлайн. Вам нужно будет предоставить информацию о вашем общем пробеге для каждой юрисдикции и местоположения и цене купленного топлива. Если ставка налога в юрисдикции выше, чем налог на топливо в вашей базовой юрисдикции, у вас будет кредит. Если ставка налога ниже, вы будете должны налоги. Система подсчитает эти суммы, чтобы определить, причитается ли вам возмещение или у вас есть причитающийся налоговый платеж.</li><li>Если у вас есть причитающийся налоговый платеж, вы можете оплатить ваши налоги онлайн.</li></ul>'
        ],
        [
            'question' => 'Кто платит налог IFTA?',
            'answer' => 'Необходимо платить налог IFTA, если вы эксплуатируете ваш квалифицированный моторизованный транспорт для коммерческих целей по крайней мере в двух юрисдикциях IFTA, и ваш транспорт соответствует любому из следующих критериев: весит более 26,000 фунтов, или имеет три или более оси на силовом агрегате.'
        ],
        [
            'question' => 'Сколько составляет налог на дизельное топливо?',
            'answer' => 'Федеральный акцизный налог США на бензин составляет 18.4 цента за галлон и 24.4 цента за галлон для дизельного топлива. Точные ставки налогов для определенных кварталов можно посмотреть онлайн на <a href="https://ifta-calculator.com/rates" target="_blank">https://ifta-calculator.com/rates</a>.'
        ],
        [
            'question' => 'Калькулятор миль штатов IFTA',
            'answer' => 'Простой и бесплатный калькулятор миль штатов - это <a href="https://ifta-calculator.com" target="_blank">https://ifta-calculator.com</a>. Вам нужно предоставить только информацию о ваших остановках и покупках топлива.'
        ],
        [
            'question' => 'Сколько стоит IFTA?',
            'answer' => 'Государственная регистрационная плата за вашу пропорциональную пластину будет варьироваться в зависимости от вашего базового штата, полной массы транспортного средства и штатов, в которых вы хотите зарегистрироваться. Обычно государственные сборы для транспортного средства весом 80,000 фунтов, работающего во всех 48 нижних штатах, составляют от $1500 до $2000, но это может варьироваться в зависимости от вашего базового штата.'
        ]
    ]
];

// Get current locale or default to English
$currentLocale = app()->getLocale();
$currentFaq = $faq[$currentLocale] ?? $faq['en'];
@endphp





<div class="front-page__rates-link">
  <a href="/rates/">{{ __('homepage.footer.rates_link') }}</a>
</div>

<div class="front-page__faq">
  <h4>{{ __('homepage.footer.faq_title') }}</h4>

  @foreach($currentFaq as $q)
  <div class="front-page__faq-item">
    <h6>{{ $q['question'] }}</h6>
    <div>{!! $q['answer'] !!}</div>
  </div>
  @endforeach
</div>