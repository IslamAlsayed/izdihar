-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 10:32 PM
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
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `monthly_income` int(11) NOT NULL,
  `expenses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`expenses`)),
  `total_expenses` varchar(11) NOT NULL,
  `net_income` varchar(11) NOT NULL,
  `selling_goal` varchar(11) NOT NULL,
  `budget_goal` varchar(255) NOT NULL,
  `goal_date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `monthly_income`, `expenses`, `total_expenses`, `net_income`, `selling_goal`, `budget_goal`, `goal_date`, `user_id`, `created_at`) VALUES
(39, 17000, '{\"rent\":5000,\"debts\":0}', '5000', '12000', '10000', 'شراء سيارة', 1, 26, '2024-10-08 21:27:04'),
(41, 17000, '{\"bills\":500,\"rent\":500,\"food\":500,\"healthcare\":500,\"clothing\":500,\"entertainment\":500,\"debts\":0}', '3000', '14000', '150000', 'شراء سيارة', 11, 27, '2024-10-08 22:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

CREATE TABLE `debts` (
  `id` int(11) NOT NULL,
  `debt_goal` varchar(255) NOT NULL,
  `expenses` decimal(11,0) NOT NULL,
  `monthly_payment` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debts`
--

INSERT INTO `debts` (`id`, `debt_goal`, `expenses`, `monthly_payment`, `duration`, `user_id`, `created_at`) VALUES
(95, 'قرض دراسي', 4500, '500', '9', 26, '2024-10-08 21:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `title`, `image`, `description`, `link`, `type`, `created_at`) VALUES
(50, 'التخطيط المالي\r\n', NULL, '', 'https://www.youtube.com/embed/Ru-yBS7wXEU?si=cknu1AUuyxjbhQ8g', 'video', '2024-10-03 12:33:34'),
(51, 'كيف تخطط لحياتك المالية؟', NULL, '', 'https://www.youtube.com/embed/erADTfaK9Pk?si=QVJSQfN2AJqC7M5f', 'video', '2024-10-03 12:33:34'),
(52, 'كيف تكتفي مالياً؟ مع صلاح خاشقجي', NULL, '', 'https://www.youtube.com/embed/reHvsmSHzhY?si=91afDytwTBxNUawg', 'video', '2024-10-03 12:33:34'),
(58, 'الإدارة المالية', 'الإدارة المالية.png', '', 'الإدارة المالية.pdf', 'book', '2024-10-03 12:52:30'),
(59, 'التخطيط المالي في الاستقرار', 'التخطيط المالي في الاستقرار.jpeg', '', 'التخطيط المالي في الاستقرار.pdf', 'book', '2024-10-03 12:52:30'),
(60, 'الاب الروحي', 'الاب الروحي.jpeg', '', 'الاب الروحي.pdf', 'book', '2024-10-03 12:52:30'),
(61, 'الإدارة المالية فى الإسلام2', 'الإدارة المالية فى الإسلام2.png', '', 'الإدارة المالية فى الإسلام2.pdf', 'book', '2024-10-03 12:52:30'),
(62, 'الإدارة المالية دليل المعايير والتنفيذ', 'الإدارة المالية دليل المعايير والتنفيذ.png', '', 'الإدارة المالية دليل المعايير والتنفيذ.pdf', 'book', '2024-10-03 12:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `retirement_plan`
--

CREATE TABLE `retirement_plan` (
  `id` int(11) NOT NULL,
  `retirement_age` int(11) NOT NULL,
  `user_age` int(11) NOT NULL,
  `monthly_income` decimal(11,0) NOT NULL,
  `debts_and_expenses` varchar(11) NOT NULL,
  `retirement_goal` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retirement_plan`
--

INSERT INTO `retirement_plan` (`id`, `retirement_age`, `user_age`, `monthly_income`, `debts_and_expenses`, `retirement_goal`, `user_id`, `created_at`) VALUES
(60, 60, 23, 25000, '6000', '150000', 26, '2024-10-08 21:26:19'),
(61, 60, 24, 25000, '6000', '150000', 27, '2024-10-08 22:57:14');

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
  `image` varchar(255) DEFAULT 'profile.jpeg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `created_at`) VALUES
(23, 'IslamAlsayed', 'islam@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'profile.jpeg', '2024-10-08 13:07:01'),
(25, 'ola', 'olahamdy139@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'profile.jpeg', '2024-10-08 17:56:57'),
(26, 'IslamAlsayed', 'islam2@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'profile.jpeg', '2024-10-08 18:25:55'),
(27, 'IslamAlsayed', 'eslamalsayed8133@outlook.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'profile.jpeg', '2024-10-08 19:52:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_budgets` (`user_id`);

--
-- Indexes for table `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debt_user` (`user_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
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
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `debts`
--
ALTER TABLE `debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `retirement_plan`
--
ALTER TABLE `retirement_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `user_budgets` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
