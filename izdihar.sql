-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 03:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `izdihar`
--

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

CREATE TABLE `debts` (
  `id` int(11) NOT NULL,
  `debt_type` varchar(255) NOT NULL,
  `debt_amount` decimal(11,0) NOT NULL,
  `debt_monthly` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debts`
--

INSERT INTO `debts` (`id`, `debt_type`, `debt_amount`, `debt_monthly`, `duration`, `user_id`, `created_at`) VALUES
(26, 'شخصي', 4500, '4500', '0', 2, '2024-11-04 00:32:06'),
(27, 'ملابس', 7000, '3500', '2', 2, '2024-12-04 00:32:06'),
(28, 'شخصي', 2500, '0', '0', 2, '2024-10-04 00:32:06'),
(29, 'اثاث', 20000, '2000', '10', 2, '2025-01-04 00:32:06'),
(30, 'انترنت', 9000, '0', '0', 2, '2024-10-04 02:25:54'),
(31, 'ملابس', 8000, '1500', '6', 1, '2024-07-04 03:05:54'),
(32, 'طعام', 4000, '0', '0', 1, '2024-08-04 03:06:15'),
(33, 'انترنت', 2000, '500', '4', 1, '2024-09-04 03:07:53'),
(34, 'اثاث', 7500, '0', '0', 1, '2024-10-04 03:09:22'),
(35, 'شخصي', 8700, '0', '0', 1, '2024-11-04 03:11:33'),
(36, 'ملابس', 9500, '0', '0', 1, '2024-12-04 03:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `educational_material`
--

CREATE TABLE `educational_material` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_material`
--

INSERT INTO `educational_material` (`id`, `title`, `image`, `description`, `link`, `type`, `created_at`) VALUES
(1, 'التمويل الشخصي: مفتاح النجاح المالي', '1.jpg', 'يعتبر التعليم المالي جزءًا أساسيًا من حياة الأفراد، حيث يساعدهم على تحقيق النجاح المالي. تبدأ رحلة الوعي المالي بفهم الأساسيات، مثل كيفية إعداد الميزانية، وتحديد مصادر الدخل والنفقات. التعليم المالي يمكّن الأفراد من اتخاذ قرارات مستنيرة حول كيفية إدارة أموالهم. من خلال ورش العمل والدورات التدريبية، يمكن للأشخاص تطوير مهاراتهم في التخطيط المالي. هذه المعرفة ليست مهمة فقط للمستقبل، بل تؤثر أيضًا على الحياة اليومية. بفضل التعليم المالي، يمكن تحسين القدرة على الادخار والاستثمار، مما يؤدي إلى حياة مالية مستقرة. في النهاية، الاستثمار في التعليم المالي هو استثمار في مستقبل مزدهر.', NULL, 'article', '2024-09-30 00:00:00'),
(2, 'أهمية إعداد الميزانية لصحتك المالية', '2.jpg', 'إعداد الميزانية هو خطوة أساسية لتحقيق الاستقرار المالي. يساعد الأفراد في تتبع دخلهم ونفقاتهم، مما يمنحهم صورة واضحة عن وضعهم المالي. الميزانية تعمل على تحديد الأولويات وتساعد في تجنب النفقات غير الضرورية. من خلال تحليل النفقات، يمكن تحديد المجالات التي يمكن فيها توفير المال. يعد الادخار جزءًا مهمًا من الميزانية، حيث يجب تخصيص نسبة معينة من الدخل للادخار. الأفراد الذين يلتزمون بإعداد الميزانية يميلون إلى اتخاذ قرارات مالية أكثر حكمة. بشكل عام، إعداد الميزانية يعزز الوعي المالي ويمنح الأفراد السيطرة على أموالهم.', NULL, 'article', '2024-09-30 00:00:00'),
(3, ' أساسيات الاستثمار: فهم الخيارات المختلفة', '3.jpg', 'يعتبر الاستثمار وسيلة فعالة لتحقيق النمو المالي على المدى الطويل. تشمل خيارات الاستثمار الأسهم، والسندات، والعقارات، كل منها يحمل مزاياه وعيوبه. يجب على المستثمرين الجدد فهم المخاطر المرتبطة بكل نوع من أنواع الاستثمار. يعد البحث والتحليل من الخطوات الأساسية لتحديد الخيار الأنسب. كما يُنصح ب diversifying (تنويع) المحفظة الاستثمارية لتقليل المخاطر. التعرف على الأسواق المالية وكيفية عملها يمكن أن يساعد المستثمرين في اتخاذ قرارات مستنيرة. الاستثمار الذكي يمكن أن يؤتي ثماره بمرور الوقت، مما يساهم في تحقيق الأهداف المالية.', NULL, 'article', '2024-09-30 00:00:00'),
(4, 'التخطيط للتقاعد: ابدأ مبكرًا لمستقبل آمن', '4.jpg', 'التخطيط للتقاعد هو خطوة مهمة لضمان مستقبل مريح. كلما بدأت في التخطيط مبكرًا، زادت فرصتك لتحقيق الأمان المالي في مرحلة التقاعد. يجب على الأفراد تقدير التكاليف التي سيواجهونها بعد التقاعد، مثل نفقات المعيشة والرعاية الصحية. الادخار المنتظم هو أحد أفضل الطرق لضمان توفر المال عند التقاعد. يُنصح بفتح حسابات خاصة للتقاعد مثل IRA أو 401(k) للاستفادة من العوائد الضريبية. بجانب الادخار، يعتبر الاستثمار جزءًا أساسيًا من التخطيط للتقاعد. التخطيط الجيد يمكن أن يوفر لك الراحة النفسية ويجعل فترة التقاعد تجربة إيجابية.', NULL, 'article', '2024-09-30 00:00:00'),
(5, 'استراتيجيات إدارة الديون من أجل الحرية المالية', '5.jpg', 'إدارة الديون تعتبر واحدة من أكبر التحديات التي يواجهها الكثيرون. أول خطوة في إدارة الديون هي تحديد مقدار الديون المستحقة وتوزيعها على فئات مختلفة. يمكن أن تساعد استراتيجيات مثل \"سداد الديون الأعلى فائدة أولًا\" أو \"تقسيم الديون إلى فئات\" في تسريع عملية السداد. من المهم وضع خطة واضحة لتحقيق سداد كامل الديون خلال فترة محددة. التفاوض مع الدائنين قد يكون خيارًا جيدًا لتخفيض الفوائد أو إعادة جدولة الدفعات. إدارة الديون بشكل فعال يمكن أن تعزز الثقة بالنفس وتمنح الأفراد حرية مالية أكبر. أخيرًا، التعلم من الأخطاء المالية السابقة يساعد في تجنب الوقوع في فخ الديون مرة أخرى.', NULL, 'article', '2024-09-30 00:00:00'),
(6, 'فهم درجات الائتمان وأهميتها', '6.jpg', 'درجات الائتمان تلعب دورًا كبيرًا في تحديد القدرة على الحصول على قروض. تُعتبر الدرجة الجيدة علامة على السلوك المالي الجيد، مما يسهل الحصول على قروض بشروط أفضل. يمكن أن تؤثر عوامل مثل سداد الدفعات في الوقت المحدد ومقدار الديون المتراكمة على درجة الائتمان. من المهم مراقبة درجات الائتمان بانتظام وإصلاح أي أخطاء قد تظهر. يمكن للأفراد تحسين درجاتهم من خلال سداد الديون في الوقت المحدد وتقليل استخدام الائتمان. فهم النظام الائتماني وكيفية عمله يمكن أن يمنح الأفراد ميزة في إدارة أموالهم. درجات الائتمان هي أداة قوية لتحقيق الأهداف المالية.', NULL, 'article', '2024-09-30 00:00:00'),
(7, 'الأهداف المالية: تحديد وتحقيق أهدافك', '7.jpg', 'تحديد الأهداف المالية هو جزء أساسي من التخطيط المالي الناجح. يجب أن تكون الأهداف محددة وقابلة للقياس، مثل الادخار لشراء منزل أو التقاعد. يمكن أن يساعد وضع خطة واضحة وتحليل الميزانية في تحقيق هذه الأهداف. من المهم أن تكون الأهداف واقعية وأن تُحدد جدول زمني لتحقيقها. العمل على تحقيق الأهداف المالية يعزز الدافع ويوفر شعورًا بالإنجاز. مراجعة الأهداف بشكل دوري وتعديلها حسب الحاجة يعزز الاستدامة المالية. الأهداف المالية تساعد الأفراد على التركيز والتقدم نحو مستقبل أفضل.', NULL, 'article', '2024-09-30 00:00:00'),
(8, 'دور المستشارين الماليين: متى تطلب المساعدة', '8.jpg', 'قد يجد بعض الأفراد صعوبة في إدارة أموالهم بشكل مستقل، مما يجعل الاستعانة بمستشار مالي خيارًا منطقيًا. يمكن للمستشارين الماليين تقديم المشورة المتخصصة حول كيفية تحسين الوضع المالي. يجب على الأفراد البحث عن مستشار يتمتع بسمعة جيدة وموثوقية. تعتبر الاستشارة المالية مفيدة في وضع استراتيجيات الاستثمار وإدارة المخاطر. من المهم التواصل بشكل جيد مع المستشار لضمان فهم الأهداف المالية بشكل دقيق. يساعد المستشارون في تحقيق الأمان المالي من خلال تقديم استراتيجيات مخصصة تناسب احتياجات الأفراد. الاستعانة بالمستشارين يمكن أن تكون خطوة مهمة نحو تحقيق الأهداف المالية.', NULL, 'article', '2024-09-30 00:00:00'),
(9, 'الادخار للطوارئ: بناء شبكة الأمان المالي', '9.jpg', 'الادخار للطوارئ يعد من أهم الخطوات لتحقيق الأمان المالي. يوصى بأن يكون لديك صندوق طوارئ يغطي نفقات ثلاثة إلى ستة أشهر من المصروفات. يساعد هذا الصندوق الأفراد في التعامل مع الظروف غير المتوقعة مثل فقدان العمل أو النفقات الطبية الطارئة. يجب تحديد مبلغ معين للادخار كل شهر لبناء هذا الصندوق تدريجيًا. يعتبر الادخار للطوارئ وسيلة لحماية نفسك من الضغوط المالية. بالإضافة إلى ذلك، يمكن أن يعزز هذا الادخار الثقة بالنفس ويمنحك شعورًا بالأمان. بشكل عام، يعد الادخار للطوارئ جزءًا أساسيًا من التخطيط المالي السليم.', NULL, 'article', '2024-09-30 00:00:00'),
(10, 'سيكولوجية المال: فهم سلوكك المالي', '10.jpg', 'تؤثر العوامل النفسية بشكل كبير على كيفية إدارة الأفراد لأموالهم. من الضروري فهم سلوكيات الشراء والادخار، وكيفية تأثيرها على الوضع المالي. تتضمن سيكولوجية المال أيضًا التعامل مع المخاوف والضغوط المرتبطة بالمال. الوعي الذاتي يمكن أن يساعد الأفراد في اتخاذ قرارات مالية أكثر عقلانية. من المهم معالجة المشاعر السلبية المتعلقة بالمال مثل القلق والشعور بالذنب. التعلم من التجارب السابقة يساعد في تطوير سلوكيات مالية أفضل. بفهم سلوكياتك المالية، يمكنك تحسين قدرتك على إدارة أموالك بفعالية.', NULL, 'article', '2024-09-30 00:00:00'),
(50, 'التخطيط المالي\r\n', NULL, '', 'https://www.youtube.com/embed/Ru-yBS7wXEU?si=cknu1AUuyxjbhQ8g', 'video', '2024-10-03 12:33:34'),
(51, 'كيف تخطط لحياتك المالية؟', NULL, '', 'https://www.youtube.com/embed/erADTfaK9Pk?si=QVJSQfN2AJqC7M5f', 'video', '2024-10-03 12:33:34'),
(52, 'كيف تكتفي مالياً؟ مع صلاح خاشقجي', NULL, '', 'https://www.youtube.com/embed/reHvsmSHzhY?si=91afDytwTBxNUawg', 'video', '2024-10-03 12:33:34'),
(58, 'الإدارة المالية', NULL, '', 'الإدارة المالية.png', 'book', '2024-10-03 12:52:30'),
(59, 'التخطيط المالي في الاستقرار', NULL, '', 'التخطيط المالي في الاستقرار.jpeg', 'book', '2024-10-03 12:52:30'),
(60, 'الاب الروحي', NULL, '', 'الاب الروحي.jpeg', 'book', '2024-10-03 12:52:30'),
(61, 'الإدارة المالية فى الإسلام2', NULL, '', 'الإدارة المالية فى الإسلام2.png', 'book', '2024-10-03 12:52:30'),
(62, 'الإدارة المالية دليل المعايير والتنفيذ', NULL, '', 'الإدارة المالية دليل المعايير والتنفيذ.png', 'book', '2024-10-03 12:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `retirement_plan`
--

CREATE TABLE `retirement_plan` (
  `id` int(11) NOT NULL,
  `retirement_age` int(11) NOT NULL,
  `user_old` int(11) NOT NULL,
  `monthly_amount` decimal(11,0) NOT NULL,
  `goal_retirement` varchar(255) NOT NULL,
  `goal_type` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retirement_plan`
--

INSERT INTO `retirement_plan` (`id`, `retirement_age`, `user_old`, `monthly_amount`, `goal_retirement`, `goal_type`, `user_id`, `created_at`) VALUES
(37, 60, 23, 25000, '4000000', 'تقاعد', 2, '2024-10-03 19:33:25'),
(38, 60, 24, 9000, '250000', 'زواج', 1, '2024-10-04 02:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about_us` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `privacy` longtext NOT NULL,
  `conditions` longtext NOT NULL,
  `invest` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `logo`, `favicon`, `image`, `title`, `about_us`, `description`, `phone`, `email`, `privacy`, `conditions`, `invest`) VALUES
(1, 'logo.jpeg', 'favicon.ico', 'image.jpeg', 'حماية عملك ومستقبلك!', '  هو موقع متخصص في التخطيط المالي يساعد الأفراد على إدارة شؤونهم المالية بسهولة، من خلال إنشاء الميزانيات، ومتابعة النفقات، وتحديد الأهداف المالية، دون الحاجة إلى ربط البطاقات المصرفية. يقدم الموقع خدمات مجانية وآمنة، ويركز على\n            التوجيه المالي لتحقيق الاستقلال المالي والأهداف المستقبلية.', 'النزاهة والاجتهاد والعمل الجاد والقدرة على تقييم المواقف', '+0000000', 'sterk@gmail.com', 'ChatGPT\nفي موقعنا، نعتبر خصوصيتك من أهم أولوياتنا. نحن ملتزمون بحماية المعلومات الشخصية التي تقدمها لنا أثناء استخدام خدماتنا. يتم جمع البيانات فقط لغرض تحسين تجربتك، ولن يتم مشاركتها مع أطراف ثالثة دون إذنك. نستخدم تقنيات أمان متقدمة لضمان حماية معلوماتك من الوصول غير المصرح به. يمكنك الاطلاع على سياسة الخصوصية الخاصة بنا لمزيد من التفاصيل حول كيفية تعاملنا مع بياناتك.', 'تحدد شروط وأحكام موقعنا القواعد والإرشادات التي يجب على المستخدمين الالتزام بها أثناء استخدام خدماتنا. يجب عليك قراءة هذه الشروط بعناية، حيث أنها تشكل اتفاقًا قانونيًا بينك وبين الموقع. نحن نحتفظ بالحق في تعديل هذه الشروط في أي وقت، لذا يُنصح بمراجعتها بانتظام. من خلال استخدامك لموقعنا، فإنك توافق على الالتزام بهذه الشروط وتقبل جميع الأحكام الواردة فيها. إذا كان لديك أي استفسارات أو اعتراضات، يرجى التواصل معنا قبل استخدام خدماتنا.', 'استثمر في مستقبلك مع خدماتنا المتنوعة التي توفر فرصًا استثمارية تناسب احتياجاتك وأهدافك المالية. نحن نقدم لك الاستشارات والدعم اللازمين لتوجيهك نحو الخيارات الأفضل، مما يساعدك على تحقيق عوائد مرتفعة. سواء كنت تبحث عن استثمار طويل الأجل أو قصير الأجل، فنحن هنا لمساعدتك في اتخاذ قرارات مدروسة وفعالة. انضم إلينا اليوم واستفد من خبراتنا لتحقيق أهدافك المالية بكل ثقة.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `lang` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `lang`, `currency`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'profile.jpeg', 'en', 'sar', '2024-09-29 21:00:00'),
(2, 'user', 'user@gmail.com', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'profile.jpeg', 'en', 'sar', '2024-09-29 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debt_user` (`user_id`);

--
-- Indexes for table `educational_material`
--
ALTER TABLE `educational_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retirement_plan`
--
ALTER TABLE `retirement_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retirement_user` (`user_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debts`
--
ALTER TABLE `debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `educational_material`
--
ALTER TABLE `educational_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `retirement_plan`
--
ALTER TABLE `retirement_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `debt_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retirement_plan`
--
ALTER TABLE `retirement_plan`
  ADD CONSTRAINT `retirement_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
