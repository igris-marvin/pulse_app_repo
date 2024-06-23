-- Drop tables if they exist
DROP TABLE IF EXISTS `emotion_regulator_app`;
DROP TABLE IF EXISTS `member`;
DROP TABLE IF EXISTS `pulse_data`;
DROP TABLE IF EXISTS `pulse_detector_device`;
DROP TABLE IF EXISTS `reading`;

-- Create member table
CREATE TABLE `member` (
  `member_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dob` date NOT NULL,
  `gender` char(1) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `image` longblob DEFAULT NULL,
  `mgr` int(11) DEFAULT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL DEFAULT 'CUSTOMER',
  `surname` varchar(25) NOT NULL,
  `tcs` char(1) DEFAULT 'N',
  `username` varchar(25) NOT NULL,
  UNIQUE KEY `UK_49wwfpomieiw32mhw42ykjv8i` (`id_number`),
  UNIQUE KEY `UK_gc3jmn7c2abyo3wf6syln5t2i` (`username`)
);

-- Create pulse_detector_device table
CREATE TABLE `pulse_detector_device` (
  `device_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
);

-- Create emotion_regulator_app table
CREATE TABLE `emotion_regulator_app` (
  `pulse_app_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `pulse_device_id` int(11) DEFAULT NULL,
  UNIQUE KEY `UK_9mj035bm0qvumkmmt3jdnwieg` (`member_id`),
  UNIQUE KEY `UK_3wph852u4cdbp4b32o7ypafd2` (`pulse_device_id`)
);

-- Create pulse_data table
CREATE TABLE `pulse_data` (
  `pulse_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `pulse_rate` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `device_id` int(11) DEFAULT NULL,
  KEY `FKmi7ldqtumxnek8b7m36ygfbsa` (`device_id`)
);

-- Create reading table
CREATE TABLE `reading` (
  `reading_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `average` int(11) NOT NULL DEFAULT 0,
  `mood` varchar(255) NOT NULL DEFAULT '---',
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `pulse_app_id` int(11) DEFAULT NULL,
  KEY `FK9qww2id39eadnre5bra52j1rd` (`pulse_app_id`)
);

-- Add foreign key constraints
ALTER TABLE `emotion_regulator_app`
  ADD CONSTRAINT `FKbpru6ht90ecv3s5o7int7myf3` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `FKkwlb113fa3wvhv8srncuguw8n` FOREIGN KEY (`pulse_device_id`) REFERENCES `pulse_detector_device` (`device_id`);

ALTER TABLE `pulse_data`
  ADD CONSTRAINT `FKmi7ldqtumxnek8b7m36ygfbsa` FOREIGN KEY (`device_id`) REFERENCES `pulse_detector_device` (`device_id`);

ALTER TABLE `reading`
  ADD CONSTRAINT `FK9qww2id39eadnre5bra52j1rd` FOREIGN KEY (`pulse_app_id`) REFERENCES `emotion_regulator_app` (`pulse_app_id`);


INSERT INTO `member` (`member_id`, `dob`, `gender`, `id_number`, `image`, `mgr`, `name`, `password`, `role`, `surname`, `tcs`, `username`) VALUES
(1, '2013-05-01', 'M', '1234567890123', 0xffd8ffe000104a46494600010101004800480000ffdb00430006040506050406060506070706080a100a0a09090a140e0f0c1017141818171416161a1d251f1a1b231c1616202c20232627292a29191f2d302d283025282928ffdb0043010707070a080a130a0a13281a161a2828282828282828282828282828282828282828282828282828282828282828282828282828282828282828282828282828ffc200110801f401f403012200021101031101ffc4001b00000301010101010000000000000000000001020304060507ffc400190101010101010100000000000000000000000102030405ffda000c03010002100310000001f9ed3f0fbec09a955399d1ef7c0fbdefe5fa427e9e20140000000000000000000000000000000000000000003122dc50d343000000000000003f25b4fc3ef60f3a98d224e8f79e0fde77f2fd213f4f100a00000000000000000000000000000000000000000004c100152ca6980000000000007e4ed3f0fbdb0cd535333bfbdf05ee3d1c3ea81e8e0c0a000000090014010028014020010000050040000140000a0000000152a0600000008000000fca1a7e2f7503ca53992fd978cf65df8fa013f47060500000000000020009a52d19e4bd271667d13e707d07c7b26c215a04626800a0140000000000ea19420001cb9280000fc9ea5f87e85a1cb0ae64af67e37d977f3fdf03d1e7627400800000085663f34fafcbe43e3e75ecfe3f97ceefedf37cdbceba230177ac05ebebf928f49f47c4d31fa5f7fe57f5358fd12bcbfdc67ad82005800a00800a0034306980024c180001f93b4787df6d39a49a8bf61e3fd7f7f2fa169fa38005002008a4b925e8f3df3fcc4dfd8f918a9d1a1e740e6d61442b448c54db12a2494d569dff00344f6fe8ff0027fb5ae7fa31f13ec5e76357200a00000000d318009a0103243f2a735e1f7d34e548595fb2f1becbd1e6fbee5fa38305630011f166ba3c6f27cd9d9a6674c732b414d3210246d0031404ac92c04140234c4e9f57e2aecfd66fc67acd72e8734c00500000a0050982609814487e4f70787dda094d24ccabd9f8cf69e8f37de07e8e0265217cc970f13b704e99144da749646a5439181086a86c1090d2144992da46e196e286e44d3d1799d2e3f54dfc4fb2d73d9a77200800a082848b268000115f935c5783df4d13486b32bda78bf65e8f37a068f470a473ae3e4efe5b7963ac3792d09712d2ccda96132543210ca04821c89a92880d148084ce8f313432136be3dae7eb7a9f11d973fa8d798f4773a269960521826a9460260200fc9aa6fc1efa05288517ebbc8fa7efe6f5627e9e079afb7e157252a7551a45b2326a26a059dc2a1b965b3299b552a9190484a4349149246924a70ca49255665cf43e619fb1fa07e57ecb58f74676cb13a0006a950c25a06487e4fa657f3fdf6d54b33492bd3799f55df8fa6a9c7d1e7f39e735e79ab723adc116a249a524d345125cc21ac84d54c5419c567048804511528252975990c812de45ce8f1ab37fa1f2f7b9fd5beb7e6dfa2de7a34c00a6e69413240000fc9aa5fcff007ead12a4da2f63e43d8f7e1e87cf7daf0ddf97cd9a2745599357095a90958c80a752ad266b58599a4445e6465ae5131598dc0092b2a44310890a4692b9751565e99533dbfa4fe5bedee3dd1354c0b10d28245a40c41f9481e0f7e97132eaa6a0f65e3bdbfa3cfd3e0bd4799ed9cb2d33cf421c32dcb5295b4596496cce3785c67494c952ace2a233cf48233bcc4809553626881c8820654d2b99b955759db3b7acf25f6ecfd62f8baeca02c4d3244c900061f9438af07b9a1377ae1bb3afb8f0dea7bf2f8dc8e7a671cef39739a4935352e952eeb4bcf6153052d2e59e991304a2cea533cf6ca5c6358215cd24d5928482153494cd204968b0d33d2e76d70dd3df7b1f21ec2c605826891a1881883f20bc74f07beaa036df9f7b2fe9fcceced9c56b8f5ce596b9ccc46932e7a67a4b7534b5ae575a99a9ad7399165599395e57292495152b11be8731d516712d3022094645d218886ae413b1699d33aedcfa49fa1fb3f1becec0158d3448d0c0000fc7ae2fc1ef0a46bae5b1a76f1f676c6796d976c659699931719452535abc43a5e01b188d693123ca714d328e5b3ab3e5badfab8ba53aaf9e536e65c9218460691906fb72ed5d12a58b48a0935975126bb736ebfa9fa6f15ed19634c89a10804d58083f22d33d3c1f41cb517d1cdd31af672777a31965ac76e7cf1ae32ccac9aacb2c23a971427d27f2ed7e83e5bceb7593a58ebca618349a5d2adf6e6f47ac7cef9ffa779063e0f9ae9c2e7abafafeac9e44ede39d2b78d569257364963155908ccdbab87e835ecbf41fcaff0054628132272808002800fc835c75f9fef684b5d1cfd126ff004be5fd6efcf1e7e9f99db9c737364d6d9ab55cfa7324e78ee8556934f7e5df3ade8a6b3e5ebe5ae4cf7cd3e860eee7ec7ddf2f573ef34f09773bfc2edf9e77fcee65661b972c43c6ad66ab679db3a39699ce88e7fa1c7a1f7ff59fc7ff00524facf3a6692434d0008015f905c69e0f7ca72ba747274c9d1ea3cb7b1efcbe2798f5de37b633fa1f338ebb3afd27d467f2fe9e6f922f7fe37d7adfc8fa5f366f0b5b4d6dae7a4d63cfd711c06e931d9d26baf35d74ae74564f0859ccd1919eb2b226e424b35ace92ea44a71a99ba94edfd1ff30f607e90f2d5968609c8c0b000fc7f4cb4f0fbd454cafa79bad35f69e33da76e58f89fd27c8f7e7e357ddcdafb3f4bc7721f6fe03d0d2939546a9ac9d671adf36ed4e72a54a062ef34bace306c73e476678de628bcec98a9d6729a8de53431a1360395bd79f6415646df7fcffd23f5eeff0091f559a0412e4a01000fc76f2bf1fb9c939b5d5c9d4747b5f15ed3b71fa9e73d27ceef8f19c9bf24b386d3378e82975d2370606187d169f323e9d5d70f5ed0d639eb0cf373f6649c71d1933cf86dc897d1cddd2ce5d5819e7ae36445c6f0272ce959da52495d67a8e4935eef9bd47eb5f7bc17bb66c4208458914487e3979df8bde135075f1751d5ed3c5fb4efcbeb67a2edcbc4f9bfd1bf3b44f3d66d2bca6aab911f4b6c3496b299b75788d68672b794729ae784335cdd09cf867e8f4a7275b4b3cdbf39196b9599cdc6b04d449552ec640d5ed8523132b5cf43d07ea1f8e7e80cfada80a103108015f8dd27e1fa09cd2ae9e6de67bfd9f8df63df97d99476f3cf81fd03e259f9e6af39bdb8fab9274c2a790fbefe3775d6b14db95bece9c0beded1e7b5fbf933f227bbe7333192986f349d17cd4d2e7d208c75c6e262e35cc975942a9b9092eb421a55e5a8fa30d4e8fb5f0b74fd87b7c57b5465c4224b2841f8eeb9df8fdf938335eb9d59f4bdaf87f6ddb97d942efe779d89e03e0fe95f9fe758436df365d7d0d4fda8fa8df2d7466daa82ef45310b834f96e79f0572a6f967326bae3b8c24595e48b1d32b1486b9cdc124222e5922d54334d72dc5ae7a2ebae1a1f5ff0049fc97d333fa5be5de646914415f903178fe8669995034edf6fe27db7a38fd86abbf006e663c87b0e59afcb97def84de9ae5ab5d7d5f3c9aee8f998b5f663e2c5d7d7cbe4f349f4fe7f131c6bac63aec915144a249cee1231d72b984e35822a6e666a64426af5cfa034294b9a2aa436e8e4d53ddfb0fc87deb3e8f7caa11657e3849e3f74d438aa9a93b7dbf86f73e8e3f5dcbedcadc36180d7ccf15fa47c56bf3fd74ca6ac826b2e3fa1cd35f333ef6719da4bcfadd529d48ca358a52c226a62234ceccf3acf5c94a9a52a6e5a26419a2df44ead229923075345d4b4dbbb86d3f44f4df917ac4f667107e550d793db1a4e914099ebf71e1fdb76e7f62a6bb716d361a6da4a9d796f27fa67989bf2cb4cf3a71739df3ab9942aaa347558ce92673504cb808732e79de77119d6579c491ac92e51b9a5bde372addb72ed2cab4269a15346ba63a26bd3c7ab3f64f96008f27b13550125cf77b8f0bedbaf3fb8e2bb71a734c31350458b9ba137e1be27e8be4a74f900f3ac95ce7413956f3823495038523cab3249991e4f3d6671acaf2205729a07aceab7d39743557353a0a8954e8ab36c49a6255cd4cd5452ea415ab9af2fa00621427d0f71e13dcf5e7f6eb3aebc689770c40c4a989ca717626bf3cf9dfa0f8a5e14e33a586986764c2b7485294a66cbcc8166f34791933598b59421806d6ba33e96af68de6d53a9a8192a196a9b690dd05ab429542284293f3f7550c515927d0f73e1fdc75e5f6693ebca84ee44c10cb10c14ebf1759e9f32b5de7cdf37a3f898ebc78edcfcfa4292520cea94666939cd970a11e624690c800f59d5bbde3a5aad15cd8db960a52c96493451156c9aaa48ba0928ac5c2e1db424825ab9eff0075e13dd74e5f66b3ae9ca9c1acd3876508b1ccf3eb39f92eff0093d31f43eafcff00a1ac71726da37e73e47bdf8f9ebe397a3e4c5f871d7873e98c6d9e59c699893560ac21b0555b2adcdf08e89a6e994db054c1e6943150c1bb8756d20b466761bcfc741e7ee5802067bbdc06f9fd4b0ebc5b0d65506b2621acf27306f3e6a037cfeb7606b1f2f70d6ba38c2f4bc8396be3fc80f3f7e7e40c5c73004165000015d00d6ba062140ddb06a905b4c335d014c0ad4236024541bcfd00373fffc4002b1000020103030403000202030100000000000102030411101220053031321321402250144123243342ffda0008010100010502e547dad3d3fbda3ed69e9fded1f7b4f4fef68fb5a7a7f70b8d1f6b4f4fee171a5f52b39e61fdea3a6f8fef51d37c7e1c9bd21d689f3c0ff2a07f9703fc980abc58a68cff00471f3d3bc77b24ebc2255be8c4a9d4324ef24c773363af23e566f67cb223712446f268875068a7d40a777162a8a42fd2b947cf4df1dc94d44a9791895eff00eea5c4a436d8f1dac91a8e252bc7128df94ebc65fba3e7a778ed4a5b55c5ee1d5bd932555c9bfc09b451b9944b6bdc94aa297e85c23e7a7f8ec60ad55415d5e1526e42fc916e2e85db8bb6bb52134ff32e11f3d3fc762e6ba82bbb9721b6ff00452aae05a5de4a73525fa2274ef1c997774a05c5cb94b3faa327176579829548cd67f3c7cf4ef5e57973b4af59ce5feff5a6d3b2bbc3a5514d7e68f9e9de3832eeb6d55ea394b4c18fd717f76571874e7be3f9579e9debc2bd5515715778d1831fb514de0b3b814b3f951d3bd75ab2daaeab39498ff2e7864c993264ce91960855c3b2bac9179fc91f3d3dfd68de0bfac673a3e0f47fab71b8b7abb6567537aef2e31f3622f05c494615e5ba7f85fe389d36b7da7f5dd5c63e6c9fdc7c1d42b717de7f833aa2deaec9d8d7538775718f9b0888af3db4ee25be79e0fbcff1a133a657db3a6f747b8b8c7cf4ed3a955c27e7f03d1e8ff126529ed974dadbe1dc5c63e7a6afaa8f6c6ee6e53c76b060c727a31fe34ce8f3178edae2bcf4ef176f14e7f73d5f69f163d1f7f3c7a33fe6bb6c5a6e33a47dba7c710bfaa3d1f35c71c18f83fc288f9b0abb2a5b54538771e8b4a7ef49eda1713dd3631f718f463e0ff12d22fefa249b5dbc8de8b487b6ff00faedfdb18f9ae2c7a31f07ae3beb447435f467b39e08421cff00e3c0f47c16ab8b1e8f960c1b4c0d0fba84ce87e3bcb489fea44b47c16ab86463d1f0ce8964d860631b1b3267b68e8906a3de5a53f2c63e0fb19d32363637a647213c888991c89cc948721c96abb28a7edd1a49d2ef2d21e5e8f57c3264c993264c991b1b1b25337084f045ee307d225512255a2cf910d98d13119ec222741f1de4c443ce8c7c18d99326e3719d5e8c9cb45a4626e2146a4ca94dc2a5d469aa6508ee7528e0966229191765113a2cff00977908879d58d8c6c721c8de6f378a426266759924212d21ba459d9e4a74b11eab6ef3577a7e4b2a0caf4922be33831cd0c65362f1d2aa6dad1798f7508879ff004c93252c1390ea1bb238b25131aa1316ac992114fd5fb5b6c8aa7711452ba8157e2ab1bcb5a79f8a116ab282ad5e523196976a4bea1e532c3ff6a1ff009f65704221e62bea455782ad436ca46d49ef844771f752e1a3fc8fbf6306dd108c0c98c484fe9472258d149c4f9644aa49934c79304568cc99d7267860896af6cecea6ea6bba8453f6a70cc2e3f897132de3be77338c234612ad2b8b271a769b555ea12a6d53fb959dba953b8b5489470491042d1a251369b4c08ce45a3d18d69933dc5e612fbe955331ecae08453f6b5f5ea11c1591f26c8c26ea54b1a4946e69efa77b4254e6d365086254ae364675dc898bec42d18c7a2d726e370d92637a31f751d2aaff00283fe3d85c108a7ed67eb7d4f746b52fba941b28d3d92b6ac92ff2618bcf8ea0a9459b14521f1c8d993264464c9933ab1eaf82e591e88b09ed9db4b30ec2e08453f6b3f5aab31b887f29a304be86e47912e18e1fe9e8d3e52664ceaf47c56acc911e8bcdbfbd8aff008bb88453f6b4f57e2ed7dd424c6c7c121230491b59867d91a7915336a1c4940713060664c91631e8fb4b58f9a4f13e9b5734fb0b82114fdacfd4ba86e856fa93d5e884674c6bb50f086cc8d8e4390e4364de07323f6410d0c63e2b8ad5116748aa27d85c108a7ed67ea35f5d4696062e2988436644391b8c8c6c6c636391379230c908604318c7da43d51d3eaec9dbcf7d3ee44a7ed69eba5f52dd0ab1db50433239117f71d24cddc3381cc94c7267db3633e3140496ac631f7914de0e9971fc7fd76e253f6b3f1a4d663d468e24888c969197dc6a0e5f72919371b8cb30d9f1362a07c038607ca5a31f750845957d92b6abf243b712979b4f1adf52dd0a91db24324486c8c990cb3e36c5458a8315b91a28f891b1224922722a4b8ad1e8c7de4220fefa65723f6bb49945fdd9faeb512943a851c3d18cd851a253a08d86c369831a32a32a4893d1b1316af463ee2d1688b5abb65675f7410f82d18b4451f367e385ed0df1af4dc25a608c4a2910f0da326e371b8732a542a4c9b1b33a216af57c5f242e088b3a75ce25467be39ed51f367ebc25e3a850c928e3448441e0531c8de6f1d41d41d42a4f24a637a2425cd8fb4b45c108a72d8fa6de1196e4bcf062d68f9b4f5e0ca90dc5f50db2c085a390ea1f20ea9f20eb12ac39b624cd82a66dec31f650bb3467b4b2ba528ac35a21f1a5e6cfd795dd2f915cd0d9ae46326c6d9f66cc8a98a99b7b2f466783e31d71c16888fd146b38bb2bc4d464a46747c6979b2f5e58c97b4138d5a7b5ad58e26d36f79e8f57c521735aad294dc0b3bd23711687a2d6979b2f5e6d7d5f5be49c76bceaf86048c0f57abd5e8f9a425db4f4446586ae258d56b4bcd97af62ac772bbb624b0f46634c1831abd5f17a37c9085a2ed2d17628f9b3f5ecd48ee579430f0607c7264c9933abd33a3d1f24445de5abe34bcd9faaed56a5f22b9b6f8de783326757ae47a64c8f47c5112285f9514bcd9faaeddc52df1b9a0e9bd6433264cf37d94448a17631dc6228f9b3f55dcbaa3bd57a7b5992431f65e8f9c50888bf02e12d2879b2f5ed60ce0ab5962e3f99521b58c7a64c8d99371b8dc646ccf348c090bf2b1147dacbd7b4fc5cd6c0e6e442257815218243d599d73abe6848484bb3830634c18ec32251f6b3f5ece4b8ab88d59ee95142f13f35296e55add9522d0f46ccf7108c090bc77168b9b1143dacfd7b1b8a932eaa90f303ff993fb4cdb955e8a67f8855b52745c4d86dc0f5c1831c121448aefe05c152e2c450f6b4f55ce4c6d955973e68901facbcc34a9e52fa6932e121a2631f61111715d94216a88f8ffc4001e11000202030101010100000000000000000001101102203040120350ffda0008010301013f0150cfd3daa19fa7bae33fe067ca8f928af0d1467bd0b13e0a28a28789f257553fa6b42c45895c1a1e235cd4e7a242c4ae8d0f1e4a739484bbb1ae2a199c212eee1f150cce1781c3e2a738c5781cbe0a731212f1be0a73315e17cd4b179df07e87c1f6b2f7a1a2b865b5ecc6314bd5f1ca6cb9ada8f93e7c0c7aa16d5b37d58e28a2851622b47a3197d18e2c5aad2cb2e5f7ca2cb8b2e129714543f06632c52842456ef8570cc728421086cbd98fbe63950a2c6f83ef90e542e2f85706332d1085c1ecb9318f4426597b58dea85b515a643d6cb132cbe0842e8c70e5b3e8c5965cb2f4a175c87a363658b23e8590b6a10b8de8c7a31c2108c7742e0e3fffc4001e11000103050101000000000000000000000100021110203040500312ffda0008010201013f01af9a1bfe686ff9f01886fb10bc9be747cd0b654ecf9da72ca9cace079ee9af9f019c065277bcd1de09bbe13780ca1d11959c06669d2659184a953a2caca9536428ac28a0ca6acd01a0cd01a0cd019c2620338a465099c06701bc06e7850a2e952a54a9536350ba365a85a02f945a88c539426d61008050be5162f8474028b026a28502141429d4161c429fffc400221000010402020203010000000000000000010011215031401060223002708003ffda0008010100063f02fda5279cacacacacdc42cf1959595959e656545842ca93ee9ac83ab26a32981be8da9a29de63d003f406e8129c6de69189da6be34edb040a817ec50d56a9743a9946f9ab20e88bf1d01bb63f6c9bc8509bfa20c798f7b54b04ff0025013a63c4e8042a0733cc6804352389e2148d39d2086a051c3af35e0820e14510d7108c22c14a053520d692b35035a166a05f8ea6f5834ca358da4c89e998a0651f48c29ac63a6f581901ea16c01bf84c4ace84a8ad859d227f1fc5ec7dd3ffc40024100003000301000203010101010100000000011110213120415130617140508191a1ffda0008010100013f216210f0ce63e9ff00618843c3399c8f9ff92994bf9678670397fcba2fc8c4fc3389cbfe5b62fc8fc99cc473ff00317e47e0f0d0267fcc5f9579e86aa3efe7fe97f17f71fdff0005f77cacd1b37668a7cff81b7f0d1fa03ea62bf286af80d3f03f484ef81c641ae3158dfd15fcac2ff52ccff0df068bad0976ce3337a8e331f38c67e457ac7ef10f9609f30749897d09f682ad85b8bb20b7fe0bf84ff36f7873a28db42c7b18d931f261e6c282d15fc1330843857c0f3a46d974930a7a8a9aa8bfe658587e017e0873a5e6f145bde8ee0d85be9fd2a5c474e7a8585636439ac6bd39893e99f3fe83c3c1c05ed9c6de0cbd139b46737e90f13333098a234866fcc47b78dd7e35ee3c2c1e18c39fe06af48ea3c69b47609a3e3d4fc9086b1f326ba6c06ff8294585878e8e67cf9b06828a4c728377d1097e25e9e168a2c3c2f9a0c3ec0cddc47f7fc0b1065c9c87e79b62d22182b3a16c84989ee13cd1e532973b65c21ea0456bbfe16228fc1ccf9c419a14e0e5b6344c3427e298a5cdcd2944c6cd9b18b41ea63782fa24fc2bd2f3c8e47ce5eba3d0ff009607864cc27ba518f14a529462cd1329abaca934462614a82dfce89878ec7d314485bdb6304d0a630f1343597e2787878b952970bf12ef44ee34610a81126be4fe8bccf685e88a216d6203e331fc85c1a265307ede2e697cd2f84909c6686e48d93778bf85b13c253d848d1c8bb3786cbdb1732de18c63213c4210d0636379852971dc52e294a346b64e85d5a2fe1789f816a1f60da4ab3b83bdf91785c3651897b630c63f0c794ca36513c2d3e071aa625be46fcafcadcd9a10538baec367fc2eca36314a31eb089e5e6c632f878aca5c52944cb90d53289713f2b14bf89a28f508d099b5109863632f8597e87931328d947ede2899021a1b87d0899652970f0cdfd11dcbac7aaf430f9a2c1b2e18b104116210787831b278a5c5f370de10988ffe85e2282e787e9f305e3867f33a06370e8c26362784884210e0a3f231b0f0ca5f0fc3730a51313d9c2728f8cbc3f2d51a97056512a1bc64b467c98f0a5c5a24258259830d61ad9c60c63c194e9213c5f74df04ff8109a1ff04f2f0f3314430cd59d14b7dfa2d9c098344c210842c2f60c63187b1acbde5e68dfb21ab4e91ac4a1bfc3721b3662342d7ff259d8da1b063c210b243f037e063420d64d61e1b2fe1d44c5a20d8ff18994b733c63da8fb3c1e0c68e60b24529471878bd0f10687b0c20cc59c0d8f37d211a16637e3c12c2c533764d0d3584c18f259528de0d851c6e8cb831f83542e7ed19db0d7b4c4cdda9dc01df309e56161041a236c18c79229443a57851f80cdbfb1c75e17b0bf6325f239f9278367459ffa0a279b44213c9b52211617c528d94b85858a1a06cd8f078b9538dc4e3c6f4f11b3e0b67ee57a181cf189b36f1ee5147a2ccd9d3981f06fd3630ba1a6ecf9f34a74994b5e26360d636120d7d1fd18de8fb2958da1f4787d03d9fb89ef625aa2851362fa9a28cd0fa759f636eb1fb8702323c0af14f17c7c8f46c2eb64153826f59bf81707e0d4be0d0d0f490d8a78de0a2a5726d1acc62a87a62336c1d0a13250eba23b6c127a25b1d69f021a5745b15be08c98b8b841b6395638dcbec5b887f87a2cf431f7887182e12b74fa4a7d0d0f4ca7512771a626c2c89a3b11744b1b124d8b27069750fc019b533a3b1ee84fb9d2486b1631b28b642c4355e06a547ffa0eefd1d385c3f443f230c7514702dd7c16e0202f45b8d76e04ded34247d14a1698e252bc9222ab8bdf93489b26b4d9d00e3a20e302e0fa3a1ec513140b0b06db18ecbac698bf812c3787383ee146bb91b6974f9fb20fbfd1a451883cfc9cfa8b36291bd35c2258582cc3c09cb42c068e468814690e07a0deb0f0b105843353180852c7c8fdb618c718dc25447c42af646aea23df06e4526928f281d431f0072fe98d66f67d82cc1644c2105a148cef95696e0c3651b1084ca26744b586690624154637aa5131f965863cfa8e2349943a1f7684f5221103f39478e9cc1a9af0648f47f04c58ec3c6c20fe833fb953f92fec6186c6ee0d61e4b0842d06fb174666c4c8f7855ff997e50f828f1e4e2732e116d61983b41f782bd3647e45fb1686a9c0d41e84dd3a3a1ad6b0231318dc2ef058852f81e1e1bc106fbf1beffc965139a98a5f28f8c3c39399c85a2218fa31209084a9a480d0fac6523467631096c6ef8138da86e373518e8b09af03f0b2f0d87d18298fd92509fe062e18db39391c4f82ab42bdc6bb1b25120871e2184af706d422627f455e84b5e3e8c35c6433e8228d42781fa367c89a1bc6acd884d48a2a3ca2f85cf58f03888bbafb2b6837c0d71290b0a9032cc622b46e2b1a64392433e0660961141c738c9e566e1b47584b302905297cac2189ec6391c8e90a2832c13986839c4d6507d202a2e34c6a14b289f7e2b13f30597113eb3eb231f8baca2e53107ba9d2c8c2f997c5289899f385d1ce471c37568dd3e48c09ac391c6c5a410574f06cfd58ebbca770496837a3e70913583ee463c4f14a513c262fb1c6b5ff000f8f73c975389b388b50b738565f068c6d6b1e083fde33237d3e7150d1bf685ba12b8b47d438040dba1ba5686cac6636c67e263161b1b294a513d885a1861e84e331b786b5fb1af0ba3e0d9478b4c4a851b3e0901cf6909ce944a28ed887f02cac253e1225595a83e66acbe35c2e0df81e1bd0fa3652e10b24131a0f48a52bbf79bd791a20fa9733621d17c134f858ff005856c489219742834ef828108bf0fda6ce9b8d0b83673063c28f58e0c365ca186d1d1684ea1a9318b4de84a5a67ec6ae86b1063165aa9c0f810d63e066fb429994981a0fdf8c222b45487c89f911378f309086318fc0d8c6fd29304f086373628e4d11558350851bf22c539085887ec2d5d45c8d60fa1c4e135a1c31619422fc3803dd2f1688932c631e083c318d8f0b05ca59427b1318ecc3c9a7fb1d07d1e85260d899785cbc51896c5f01cec5a62d60da14817688ecb4d89f91028268e0f1078783630c518d8d86f08512261309eb241985769e872220d14263144ee28da8da945e139c1a7435ce95e8c3290298d690485fd0b1c3e30d659d1e0f0a363784b12e114b859536425a1927c9082416166a4c21e385e60970134d06bd7d609fde38262642284f06268f81e0f36c65c2c82588421059440b4ec66c0a22c209795c442f307b17326908ad4e9fc13082c0b07831e0d8de8ba1b186f15297c145121099841ac2c968617f72c4529c4e62c2f4cbe996da43862878344385c18618628d8c5186c71bc1b1e50a7428b307944108474682627e14a3683ea705294b8a3651a12d2c8e1c1bd0cf91c669958d8c51bc186c61a0c363147e086c1082f1084ca42c254d970c435873399c109f856f1ec7c383630c881262d898d8d8d8c61b18c7ea8c60bf64dfa9941210b105e4db1b51f51b452fbf8c7785dd0d7947a0e21a620d898d8d8d9461b1b0d784b0288e89b26c689e6108242585841a2899c1fc134380bf0aee10692150301bccddc1e06a3c0fc2dede1bca5817d31a8913133084209108259b8651f4763687017e15d216c27561de87be897f051c1a14370a360d8d8c3637706bca427805217984164242a10486b144d9736d9c0e42c529734668399b1fd0d7b152d492ad0b67521aef1b0ae168c6365297330bf62a12643a25e1109e1213090fe9a294b841441a209fb6e61245b54db71e42e16c869b07ec96479846ec6e106357221334cca505042cdc2f29082e8834255945e1782e075e9b190aba320ec747581873840a1dc47d6102609bf0b109e6a10b25842f47033e30e27fffda000c03010002000300000010fe9e2bfbcf3cf3cf3cf3cf3cf3cf3cf3cf3c314000000000f7f79ffbcf3cf3cf3cf3cf3cf3cf3cf3cf38f28d000000001f2b755fcf3cff00effdf7efbffbff00fefbef3c23070001ce3051bfe877cf3cff00efbdbe8f74d68dff00fbef3cf1c704f1cb0c9bcd74fdcf7df7ef9ef28f6d93fa69fbef3cf3c620330f0c7d4f153bcf695ecd1fb7aff6fb755ae1ee7cf3cf1ce1ce3cb8dff5ff005e3ffb5b5d7afdfec9ff00753f676ef7de3471cf0c1bcedbedd038ff005fefc7da7df3cf5de2dbbc73db1cf10fbcbecfedb9e3bbfba6babb0f3cf39a3135d27f7bff007df00fb2fafbb7f095bfea7759dfdf69e71e3891cd0b76df3de3ce0cbbb7eeefff00bfdbc734ff00166f6fd63dff00fefeabdabd638f3c387cf4f1fbbdd6f731ff00d37976ff007ca3ab7ff77f7fb3473cd3fa97b1f701e077dcb7dbf916fa7aba3f6697eb3fa1cf306f6f7eff00f67f13b9dbfdf77f9dfd7ff1f7eff5cd5b53c30caf7e66b7f77f1bd3aef81eff006c8b1ff2c7cdb56c5f534f3cabd33a7fe156dff9ff00ff00cc2fcbacbff7de8bfb7ff6ebac41d1def0a3df2fff00df9e7ceebd67cdfef746bdfbf9ff00d8ec71ce3fcefd71fc7e5fcbf74f5757c77ff4cace7b7fbed960c1ff00b3bfefcf6c3fe36de3dffeb39a9cbfe3b6ca70bfc9e0413bcebed7947ffdd7f8f1ff00bf71ebaba7d5b6befc9f3be27df6ddbfe237b7fbdd7d94df5c758f173dcf9f7ef7dfdef971fbbb3c7b1c7e7bbc3eb3c111755f78df6c0eb8edbe9ac8f1ff008ee09f9f74dddf7e7b4e71f6d72d75e7fa3b6aff00576b43d7c33cd5c5afeeef8bfbfd7fd3e77ce62f6bdfff00ff00e6f1fdd59e35c5ff00feeffd4c62a39842cb5fd5ccbaff00ff00beabecbc7b6bf9dbf4b6eedfdf7fee90e3edadb387b6e9fa8e5e67b25beffc8575bcfd5fdfb7de6da69f4df5dfb2f6d5bfdceacf592f4e77bebdf6c63ae3df6cf3f70deee9ebfbc639d1bbbcd95f98ddbfedc9cc77bfdeb557c7e5bf6e5f45ff003171cfbdf8ddb5d8b4f1cf3f6cf7abfaf6d2bfbfde56e3edef57dffd19641dbadfe7f5ce3ffa3ffdfbfdb6f57cde36ab2c535fb30a07bef018df02384309f8400bff00a3f2103d85ef7df23f42ffc4001d110101010100030101010000000000000001001110202131413060ffda0008010301013f10ff000000cc5f529f078b0c4b2c16591fd82493d424f009325883b6edc19247f5091232f59778b2c397d8df00450d9b368cd732243c1fe2a59f9c3c608d74030106436d96483e0cfcbd7f15c5f5ca64bcda323113243041127167ddaf2f96dbe62c9f9cad9b69670e5be19c224b24b25cbdf827f12cbd4e5bdb8166c43641324107165de9219325b6f91be23b2460820b20f366cb213092623c8cfc94fb78041059cdf26482d9496426087c8cfce346c2187a9b07933332cb2f09249e2a661c9308fb10f024bdf8b333c2cb324927899f72fa8c325d8208f5c0b2c9e7e7365d899364932663c812cb0932dd82098838ccdf9c5b78cb2cbb331c1e03125e92ed9044fb820979964b2f51d99666c8f4b2b5dcb222fb7a4304132c4186cb2c94a52d86613cd87d4edee5904132d8321093347608804fa925976757b4624ce24937ab7264b2ce6c47559656f76a4c2c32cb66f19901204bb2e7059e333d7830ca70eb0275144703662e43b0d8e32643a0db6c925b6f48ebb115ea62652c9b3ea713b89b2e4a5d88e133e210491c9631136311a936c24e7b4913dacce1920be16c32cb641d08278591143b06c21c1892496412464922fcb2092624bd1dbe4b2bda2194a4489424c5dbd736586c25e0db64164cb7e7024996c22194328722e96db3cd996537ef02cb6d92482c86597d70784a195bb105b6d96413965992182ce32492cb3bf1d3f61865b08596776d8232e4b6f02124924927f03fb2c32ce0701efab4e3d52ecb0c4216492492471227a259c18c45da2336196596598421041659249059113cfd41b0ce2e5873b705d8653165d83620820b2cb2492cb2f5c7a2db2f57eece37c16cb2ec9241b00970445964ccb9e079fa999be7878f8e7e2fde331e0111d67affc4001d110101010100020301000000000000000001001110202130314140ffda0008010201013f10597afa7f62cb7ef1f4fec4920f708faf876db6db78b13f1acb04efa781649c6db6db6d8f7244fc692431be9e0396db610edb6db6c3117619f8d9bf7c85c9c70bb0e5b6db6cb0c30c3f1b30fbe03ab2962fab6cb2cb23990c4350fc2cdfbc9f5c65b24b327e21861f30b25c976fd943ea5bd497d4c925fbf110db0f88db286fde07d4bd5e337efc4473f7cd761bf670cb6db0db2cfb93bb6f572db618b61b6cf1492fd8edb9306d972d86db7af0e65926445fb1f511e29241ee10939b1eecb383cd978716d962248623cc7be5927836db6db2c96591c0db24820b2088f31ef8249e16db6db0c1659d1cb61d824bd5911e2b2c3ee51292cb2c9e90d96496436dbe0cf138b2c3ee56dbb25904faf01860b22c92c820c8f33b907be33609b2c91932db6221d9883b2c1059f01ccb20f7c05966f199249264c443288418f88e265b07032c63962c926f4cb2757a419c043f0edbc10f04cdb2db0f9a59c17efc3964bb047dc7389259259059f0b721b7c965877892c1ee50f1e05841249659e46fd88f1661b6596509324c960b32d8664b2d9e6704701e49243c492fb723ea64826625b6597bb041913f0e5924907be06fbb24e2db2c32cf7f62225f8ff660e4e1c4924920f15f70c30c756db2cb2cb2c9e0463873249248f1cd884227565f30188f00e366f093041659041077249eedb6cf188e3e9c381c3e9c31820b2cb20938bc2ccdb6db6c3bc4b20e16cfa8363c0a37c5047258766de32edb6f17adb6978663efa7dafa47887a3c3c38fdf078cf3efcffc4002610010101010003010002020301000300000100112110314151617120913081a15040b1c1ffda0008010100013f10ff0002fb2ecc3fbeff00524bafff0014865863c77ffc127eeebfbeff00c247ff0018b0fb86f748202ffc98ef60670ec200649f6efadbdafc3f4bff002973ff008fcf0af3fbf0667a8b98b9ff00160b811be13b7b47fdf73fd247bffe3be373e5fc1361ff00920c8e70f0dedb69fe36dcff00046fbb58ff00e3649e07c8123eff008f2edb6dbe3e913e190b1fd88a7e64311ffc762f7253fcbbac4e5b6cf6e72d7f23b3bb99c9d393429fa5826c19df911ff2a87546bd1cb41cf027db47edc8ecf0e36ec0b627a5bb70ec11f5779cff00932dcf45a8f4be7973c3d7af1967967061e481ba4b1fec83077b88ff0097fef2099fe94107aef44dc9a3b5ff0075ce7fdf3881fef9ae7fba483fd8b29183388cc7a5c7786da7bc82f77fe560b61b6db6f93ee3c88c83ddd432ecaddd90b1833e90d393e0ff00379e03ef87d1c8e51491f5f2d9c1207c77521a57c67fdec7ff00dc6f7a7fbe3d6ff7361a2ff6cb9dd9c2c984861266e09bb074601a6c3aa646b1928edf0bea7fc48a8c5eecb241ccbdbb1e36f46218bdd3c1e25c7f44777c1fe63d46d5209d08b25ef11fa4581df5638cb50725df72c5441045d99f56b1864061d919ee067b9fc32a8d36031e2388cf93217f223cc79ee329b30629b29947d7fc4791f29d588f573c73ee32eb97af776b9e319b618a6e967f96873613dcb8983c518b6e9f061cebfed2656f6c2ddd6d71e977d0e4f0481f177ea7654f96ff0036afdb17ec285acbf8e478bb6388e3632bc8e0bc3f9833f6e47b15cbaf1ea74f1a7edbfe45cec40bf3ca596db6bf9e0bdbc4bda1a3fbb77bff003619af6c7589fdc954687ecc393d3dc91f7b687b4a3f318c3e5a7e78426161b090d9d6c89964f13e02d25aa7a8abf5d8a7a748187b87d8c11e2693c467b2c3fe153d82666c7e7f82f6bdd8976c067e9616b4dcff0032ed601352743e4eee68a9dd8fd7bb064de1a5a1f2d224de371f6763fb9b208961f72f3dca463e99c7607b5b7b31b13d32da38c1a399d89223a7b3b03e36ac6fdff80626f9e0fea07d2cfe496e9f24f26e3665cff679423d78df9278201aa28783d38afdba5ed2531bdccf0bded91e1f09e179661f764b899b616cfa436f5e4a02e6ecaff30f71274437644ee982b0b0ff00063c12c7f8e48c63c0ebb37abf74f00762f9e36735f2367cf89a4cab9b388e44eb2c6df0ff00b9eb71d923c3e3261e4cb609afdb1c1dba1bb6918e426589d85387a8bb263266e684911a207bae8f605b13fc18f04c7aff001534f4c2324cf8c039f4f0b7bb93a22001701b16b1cf93fe9d6dd74ed9ec3de385af6599ea5dc9bbb13e3b64a912fe4f82cb91fa2513026c0c0b11410ae6c3acde47949df93eaa6e7600c1b6978095c2ff0083e76564f21e7f80ad8212724f1c7f7177fd1250898b5431bdce5b67a58eabab1767db25712af207bb3a9c49317db2c8889f3495dd988816266b1b5033a5a90e8da5f73453db13ff0048f225f772483d9b692b3cbef87c88f202cb3fc02ef8d83b9640fcf19ca9f663a7c2df4fd9e0edb1b77c590069ac97d24f4bc81de58c87d2c5f53ba78cb9c95bdc07e58fced8dcc9b19eadf9665657ecafbdb273207b933f3b087dc87db4fdf0502ec70c720bc9306f2258e636864c08587269a8243bcf39658fc803d16db669be367a41b38785f1d8fec834be5906c8555e6418dd52adeec88ec9e1902c6302c4f6cb36c9091f07d4f492cb84891e9905ddf0b6fd9ea5f0b6d94ef6dbab0603c818b18eced33d221f580cee8c2e99fe244f84308a5362f46c32fc9fdba9b3b1d27cd26c2f3971d3a9938204dbce244ad0799ebdc453bf65591f727e5b2f659f2a2265964c661f6c41c81d7643e4d6acbf2f6dd9c9926c4a46c3f76c7ad91f9290891ed64388fa6458b8c8687a0b436e9766e75b7fc02cf527db39b0d6ce66b7f76d9f8ce5f1b2f43bf6646601fc487d40dd6d556aece54fe37c299231662e9be6f523b65965939397f0bd939cadb6d97cb51bea44fb258c975979efc29fdb1f5705deec1876293cd9b88e089403911fe027d4fa9f26b700d9e9dbe5cf5925c80c8ab807e13fa77243f015c7b3981ce37609b5f99637d5c3df81eac664ddc82837e6c7eed9ecc78e5ff72e3996fcc96787f85ac9cb671f2fd77c3e0a9cd9fd2176d64fef831526fb84f3669dd8dd0e39c597705cf7104e9b1f484e9e55a487996333c3cf19928f44fa8f5b23399072caac0956227db0076c38ef85cf1285a93b61ed802076e48304824f074b0c7df83ea7efc0cfa469992c32db6cb2861726235ace913b6157674690b77ca614fd443b3b6e7b6bd21302d2eefae5864049fc9103f8241df911e9a4f7678ad9e1765005fb292df4cac5f90475b8db72083be030fb9110677dcc6c1e2189b7bcf09ff30e6c8cf721d2d07b23d4b6f8591d9483d46fb910480567c00f6dbdcfd00d98d3e6c9439f71f2e7a61f49e040eec27b946d8e2d9f1cb787201e6481f3b2fccbde3f49a920e8ee4aa9cd66606cea5f6669a62dbdd9df11cc4d27257d21890956facafa9325e0fddec979e2eda2eb67a6de96db297c327c42fce4514df62467bc9329fa5b767e17c67ef9f6be37c78df76db702c87b2406e1830963de5873eb2916183db3bb05ce58cc3abb639c877641f643f6dcf57a36fade821fa78008037090fc8b1b3f921d2ca666bf27035ec6e14598fa631a339c6c8eb6d6c8cb6c87d33be14fdb4c9c2d231f646860615f933d41b2f9f3b3dc0f77d59e3daf8f963de7863f921b33708685801b081ff6900ea20f782b19ec636cce2dcbe6f4b965d21043366582ce7decfb2e4bdca3d592ecb65e392c6123774ef87bdb7c74cbd9e1f0c772d9916560b467244e1d6cc58c4c9d7c6db6c08041cbd16c18385a49f12565b93bf7d6fdd27652978f9f276907a810e1e3d1f1f64f5f72e7b977ef869b7bec9c9eb312045b52a3be0178c9d879e1bf26408f8478d73b179bd0c9d5d6264f7e36db60c300776041ebbf6f49093f48c0beb2da7e8d90cb0eb175f0648e9f0f6f3702467bb1901ac5e07766c7fcc7f73aeec7f58fadbbcc8b2e49a5a301f24d4c82d997657e40fb9d8f53ee7e4bb613198888080a6fb4b3c33319fe07f38b3ac8db1974b872d21fcdd0a48c6203f6c1b0ec26037b7c3dacb9c8f07f2c2fd991933d5d59a348cdea49772ebe7372198b2b2c931e5b354e48299041ba10afc93dc7e497ae4fbf1b045304b7464551cc1b70013fb3332bb6acce792f5247b077dc7872389b9f9b1c121ad4d6cfd2ce385ecf8fddebe4d1f7008534963460bdb2be939f4cd8f65ef6fc1ec9dd6eac8fd407418c0580358c307b8d61a81025d1c5245237f8ba47dcc10601fb21925fb019077b3fcaf4dd9fe53cfb19bea7339233b16beba4508dc081a03bb61f9332bfb6bd4393f657edbfd62f5be6d8db184b910db058310b3dbdaf48499b24bfbc21c1bf65f3b7d8deaecebec5a61d7b3efb941d6328af4f61b8a8b4167e9912ceb9b3acd6eb673e4722254d42cc900c8ae329824fa42c93f7b6a9eeee7b9dfdb65c9fd13e48847ba458c734b604ccfb9c72feb7ea665e908ba9f596e3b270b43b0c63c1fe273a5b496cd772d8d88ee2b27d8088b01bb057760060c2c413213edebefc08a166abb16958d5141c22c5cd1038f4b43631ddebc95bc5ce8c75a6bb8a481bb3dd414d7dc375c4b174481210f5d991a5abe1715b5b929eb67201d9d30d8d45c64c17d34999629184e60d98e6ce5ab67db616beadbb2f49f1e47a3100b00414b3165ac1a1878199eeca1bb07d5dfdd99eede7b8fa337d4c3dc8aabe8b5b96873dcddec15419c776f513e81cc818a4903a6736e957dec1ca9eaef5e4109db0f7eac57ebf884cf418824e0dba061e3938300c13ec010bbeee1879b2b58d6e0b7a24c0b1e0be985c110d7317e17130675b2467c3e47459c0d96fc920e4d84cc2ac210de44759d18813712145f5b160dafc997238b061cb2dafadb727325635d9cc1193e8dea36dd61fb907ddaeeb7df6474b638cfb74bdb2dc338b37713aef3b14d84818fb3365ba6e25a5bedf52ea218fe41846864bb1912afa634e6e459b92f52d61902eef639c083d672306ec04326d67ef22b6b6c01d7262e393953b934eede247e4bb71df0f9f69b92b6ce996309e8365172286e42aac5ed159601261cf85a4e8cefe0dcc6c85032c9e7b3346eaed840c6057777b1e3170981840f7183dd81ab211320ddcfb3083f3223fa909d815a2ff006c41ecb7759578ad719d99058dc55edad73593aa5cb945fdcb8d04b35a8206331594b9039930e84dc83d99f7ecc0dde6485d4adb3e88ff0018c20d6d83424bab207d362ee77200331d62fe630c871fa57f1ff7636306336c08b8ef3969bf44c1cc39dc8a87220c5dd6ca2e9f92cc8813645dff00fa9d2beb2c05a4ce4cafa915589f92498619a3737784d81785d60245c39b61c890775edee183ae4a4e90e80c2417f36e8bbbb277613dcc806107b93d365ef5b5d79057b2c9897af72ddee0c0398d884f27d16ff904965d0b916c43d692bdeb244a247d7d97b58103656df0d063eef1b68a55d228d0de920762b1d196d0c92f762ec168cc8f0872c6bb63139ead9e1667b2081b692efd93ad9f71647b30398c86e330c65075960b2632eb312f8925eaf0277b62bdce277d9603d90f09218fdb5ec1fc2c28c76d7e5e8e5d1b1fe1b0ec24def2dfe4ba76d2490cf7b6d5dee495c8e3f6e6862cd0d8e87192fb433f629535b1c00c79bf902e4d087064c5935c1390b512f4476702420d7b1bd198784ebdcb0efb8fa29333656e2c6c551dcbecc76640ce6ca69664dbd3183b29fb15f458d24fb6b9c9d83d83c6630c9ef59212af26219cd89f874b6a3d2f5e114f8465e8da1e7b06edc8f87366110fe6e7fa48899bc626fe9985727329651732169c3fb67b7fea9b0c1f1445a13bdcb5a13c06ad26cd14dedbd8bf6750203eae3d2038961e8c9aecb75b275d8d7af277ec2cd59de9966cf1fb9f7e1ebd48bdf519e12264db912baf96530ba1875d9a836c1f7ff2916bbc27c429c6c4eb67dc7af2dd9ecf5f49cdd26e3b27fec279fd65b04c8e718cdd0bd6299311d93e85fc05ce440e428e43832e533e4aee2e441f73f2327d99ea6cc2d7d836d887f97e05bc8db5e3185d821d98d32d8324069d83a082d9f7c7ea7dcc5963d781b60764e85afd64802d0eb359f5a803779228e5db17ecf34d8f7e764853dd7c5b24dc5aff00b0bff05cd6fac886742481e0d8c6ad811b3ed0a7249903001b7c064c33062d800dabb2c719ee201b421f24416dc5b3f58fa1ea0d762d74f57116c20800e40ecb06f47c1fb7b78d75f2d90e5ab19560e4f6787621f7d230374627d612f4daa49c2e1952b6c8b12f593620660131feebff003d9c47f2254e09c661bb2af7ea4d1f96afab5ed3470906c962b0ce30e7194fa603ab026bbb20764e33917d47deccaf8cc66c4dd5c35990ac06c0241897665d3296f6f0993cb658f684d80569517d26f0d888bcd265df6121408017505c39296dbdf53b9992ea4b9644b60bf3e7679fd32e102173594b0e1b10706b1f521b02ec955c6226bee651c3d16b584cfb701846ee7b6da6036db176f6612bd0c716e2dfacfb5206621d3e704dc163de10416e978fbd8ef3c0bbaf7c1c25fe637e3e1c69b68c7318f848a24a63027f73aed703b671f69b6f0e43bdcbbfb6872c58f1abccb71cbcbbd45cba53f6ce6fe1180bf72407f52207024a2b3acca1f63679d88fb4e69362db7fbdb4809e89b4502e2c13bb63e336390bd0dd4e3b6121938160ea7820e349558cebd31cfb6d88d8176d0bae976af5bdefaf02d6b236a192c0391afb29f06e9926ecf109868c5d5e69248eb100e10706dc94b4fcb4fcb01c0b8342eeedf2109666316bfac833f79620ecef2ba57ddda57366f4fa64877913fa646d0f0ee4a6fea6e63d9301536dd0e4940361719c0ae43056718c380e6d34630e80974295bacf10e126eecafdbbcdb268f6f6164375f72ee5ef62e2c3601a906e40ab2a07d8162441b11065034985c60e8fd2d7cdc0b19b89bfb3e71f4b01df70bddb2c6ec40210b6530b5ba4e6489ff30257e17005a725353460b92759b8f6b5845ae40e990139edb376058440a0e205d8c207ac81ee60e7e406eb19b8cfa8327b6c1d593706473bf6d3dcbbd4b793e65ec9fb9f65bb87207c2c3499d4363bac1d2d721772e43b65db10cdfb86964ff169757c308cb97b0cc6323aaac3f964c03397585958f77ec8ff005cf01967ddb0faf2c61c327beba64859a6300c431cbaf0304807632019b2ca589d437790bdf2c075ba3a5ac6c09544adcf88ad1b68eeb0e0ed90b6032e0d96ecd1709f167f653c945d901a3f2037b2ebcf0db66b319c81d64029fc49e898664884713c59db4d720ba39d8173243edd8c33e5eef8b985d124fec96c5fe20d0c2e0962e05b586e9922ea7589cfa2c67022e39740b8fb668dc85ecc386cfd5026a449b26966c25349b33ed254ecee2c0e46672093e92e4fd91edf478eda4a4d49565961d8dd2d77fab7c72e73916da667db92edee4e85945ae7cde06b0f7e26c1c2b273d37246fbb0fc83d65ecbb09f9d8ee1b6cd7ecf713e12e0248fcb4600692f93ad3a362b9d6e4e15cc07325131b9a764c3b0681e17418cfa38f24fa480776d35d8f426e5a6e9f52e8c082c0002cadc84d30b4cb5a765f36f55d87776fac99820f2c4f6cbf8b2760f792dd7255b9dbb4e591ebe40467a83ddcf847af76f64423840e2bf2f576453efb9ae710d5195e83a44c3141c67be2f6b71d8181e482fe49abe7cb5e430c7174cdd7b272637196830d6681b7601b7eb6d2642e489c26a3560759d44df29d8bd097d4203ebd085d196a4f703366fa95b72724b0166ef27f8c88af94301cb64b9cb5452003909b43b089d26f0e1cb4cecaaaf379259037723b91f58f3641cc83e41f5b03a33705d33481c0f71ff00df0aa7acbacf01b7c270b6ec39146e17d48329d7390186c8f640c45fb0622dbcc94e5a9899039091f2b7f205faca0cc9cd61d93e67662ece403565348d9c9993f7920917bafe595dd653336f702e43cd230201cc2e3e4fc58948f2e1b43ec0f8db33250124bc3af73b62ecfab083b6091d2cdbd7c9101a4497f9b27f597307c08f01b2dfb361de6455efb38ad3cc93a094600a46b00f2c3f24fe43f907e432090d581d9c2c5a2b114de9366f6d636a2ccdbef86dd6176223220390428fb9127b64e4616f864085f53402f20cceccf0894c03db1cedc7bb7d3b633a9eeffc37a1e04783275e9b1817d1924ccdee4364371d7dd82d52c1d16b7149f6862f80f580b0b1af7ec0cf70c2c6e6cd1cf66780466dad726ef3edc9b2dec58f657655d39b6f7c6d4e49cc2471cbd3cbeb900907967870c99c8f1f87ec543b2563fdefcb2c076f4f05c2ebb7acf04ad2eb5fd2cffd7030821d2c82c80f32f6ac65e59ee05027d0824cf6c7ab0104dc6c3edb2dc7c076c5ad99ecc6ce5f2e3d8ba4dd9256f80ad93b6b8bd913918049b0b461ee49930bbc8f83b7d24571f768f5bd22f938e58e5eaff49bdbf09b8887a78137cc669ac729dc67407137d489f43702d96e9ab1190d9f49b0f6c50e48c849e227603dc3eac91e319bdbbcd511020f5917574f568363211ee4244e3c1220c2103ec97ab072c427d65bb060f6b63722f6fd2c7fd64044091ef6196db65b6efbb05f645c06e66fd90c1cd6d20798c2ad913723ced89edc7dc3555ff721dc6377b7f25dbdca1913bb215c60df703a2ccd7b67bdf1e7922b96ac213b26a7b5a99678cb3e648ccb5af6063c211f99036a63f6e641d6f533deca7123cbd248ff004936214ac86db6db65874120756e70b991af1b8b0fe7058f61ba081089fb21665c7e4888fbe49ce5a6ece371f1277b26fbb550d9247ceb96537cbef5c1e1e04ccb2cb5dcc98427abc010b213e419ea3186439d2e825a01f522cbdd25cd7984fb91be0f1cb9659fc4fa274aac897e6ec6227a49973dd564ea39b764785a7ee924d73d767eb211cc9ff2fe187f17e64bfa5ee327f5c8a463c911806c9fb2d9e02d35f90f353188ca676fb475a9658fcb399965fda36eec6fdb6afe281ef2133ef4b038167f10365d247ac819eadb05a4ecc0ff00241d7f8206111fe60577b17ab996dfcbb31539b6927896d8756f8f3b16808917793fd426695e3493d6c87609977b708955f1924bf90e8c5a49864e0762631921cb2c89d6f2485e03f9271929ecbf8a43e42fe5af7e169b79920bd9642ffc92dfeb2e3213c3162dd9584fb259e891a57b0700319a868db408b8a5bbe1bb2766150930132f6c760fdb16b1b7f5e484bb6f70629ddf93fad8c6e32dbae59f6c54e58fcb0ec2e225702c439dc8b8a59c617665c83c3908fe11320cf905fc1160e483cc838cbda839386619836cc9b74933fc33ff00a644b9099ee52e5b0377f6c832217765d460deb5d8b209214894efdb2c27c0ee4001d7977b936c16d28dc2c603a487c9bf4994af05f72cb2e3f231ea0e41a722c73c0fd16611eda6485c9f5e20464105d332dbe420907c83d9389013fb3e0f6de85e97bb7aff00b2ff00cf2836bb6f8d724bef7cb523debf2fa9f66a36066f6cdbff00b9f11e98b3cfb7c894706c4f1ee22e1f60c79122d4fbf078658df523f2108764e1036f6f05c66f67c7a7811e3daf48710987a789ffd9, NULL, 'admin man', '123', 'ADMIN', 'admin dud', 'N', 'admin');