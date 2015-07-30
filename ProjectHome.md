基于PHP5的轻量级开发框架，提供WEB应用开发的快速解决方案和最佳实践
# 庆祝ThinkPHP6周年，发布3.0版本！ #

官方网站：http://thinkphp.cn
官方代码托管已经正式迁移到Github上面:https://github.com/liu21st/thinkphp
![http://thinkphp.cn/logo.png](http://thinkphp.cn/logo.png)

## 简介 ##
**ThinkPHP**是一个免费开源的，快速、简单的面向对象的**轻量级PHP开发框架**，遵循Apache2开源协议发布，是为了敏捷WEB应用开发和简化企业应用开发而诞生的。ThinkPHP从诞生以来一直秉承简洁实用的设计原则，在保持出色的性能和至简的代码的同时，也注重易用性。并且拥有众多的原创功能和特性，在社区团队的积极参与下，在易用性、扩展性和性能方面不断优化和改进，众多的典型案例确保可以稳定用于商业以及门户级的开发。

经过6年的不断积累和重构，3.0版本又是一个新的里程碑版本，在框架底层的定制和扩展方面趋于完善，使得应用的开发范围和需求适应度更加扩大，能够满足不同程度的开发人员的需求。而且引入了全新的CBD（核心+行为+驱动）架构模式，旨在打造DIY框架和AOP编程体验，让ThinkPHP能够在不同方面都能快速满足项目和应用的需求，并且正式引入SAE、REST和Mongo支持。

使用ThinkPHP，你可以更方便和快捷的开发和部署应用。当然不仅仅是企业级应用，任何PHP应用开发都可以从ThinkPHP的简单和快速的特性中受益。ThinkPHP本身具有很多的原创特性，并且倡导大道至简，开发由我的开发理念，用最少的代码完成更多的功能，宗旨就是让WEB应用开发更简单、更快速。为此ThinkPHP会不断吸收和融入更好的技术以保证其新鲜和活力，提供WEB应用开发的最佳实践！经过6年来的不断重构和改进，ThinkPHP达到了一个新的阶段，能够满足企业开发中复杂的项目需求，足以达到企业级和门户级的开发标准。

## 协议 ##
ThinkPHP遵循Apache2开源许可协议发布，意味着你可以免费使用ThinkPHP，甚至允许把你基于ThinkPHP开发的应用开源或商业产品发布/销售。

## 特性 ##
**CBD架构**：ThinkPHP3.0版本引入了全新的CBD（核心+行为+驱动）架构模式，打造框架底层DIY定制和类AOP编程体验。利用这一新的特性，开发人员可以方便地通过模式扩展为自己量身定制一套属于自己或者企业的开发框架。

**编译机制**：独创的项目编译机制，有效减少OOP开发中文件加载的性能开销。改进后的项目编译机制，可以支持编译文件直接作为入口载入，并且支持常量外部载入，利于产品发布。

**类库导入**：采用基于类库包和命名空间的方式导入类库，让类库导入看起来更加简单清晰，而且还支持自动加载和别名导入。为了方便项目的跨平台移植，系统还可以严格检查加载文件的大小写。

**URL和路由**：系统支持普通模式、PATHINFO模式、REWRITE模式和兼容模式的URL方式，支持不同的服务器和运行模式的部署，配合URL路由功能，让你随心所欲的构建需要的URL地址和进行SEO优化工作。支持灵活的规则路由和正则路由，以及路由重定向支持，带给开发人员更方便灵活的URL优化体验。

**调试模式**：框架提供的调试模式可以方便用于开发过程的不同阶段，包括开发、测试和演示等任何需要的情况，不同的应用模式可以配置独立的项目配置文件。只是小小的性能牺牲就能满足调试开发过程中的日志和分析需要，并确保将来的部署顺利，一旦切换到部署模式则可以迅速提升性能。

**ORM**：简洁轻巧的ORM实现，配合简单的CURD以及AR模式，让开发效率无处不在。

**数据库**：支持包括Mysql、Sqlite、Pgsql、Oracle、SqlServer、Mongo等数据库，并且内置分布式数据库和读写分离功能支持。系统支持多数据库连接和动态切换机制，犹如企业开发的一把利刃，跨数据库应用和分布式支持从此无忧。

**查询语言**：内建丰富的查询机制，包括组合查询、快捷查询、复合查询、区间查询、统计查询、定位查询、多表查询、子查询、动态查询和原生查询，让你的数据查询简洁高效。

**动态模型**：无需创建任何对应的模型类，轻松完成CURD操作，支持多种模型之间的动态切换，让你领略数据操作的无比畅快和最佳体验。

**扩展模型**：提供了丰富的扩展模型，包括：支持序列化字段、文本字段、只读字段、延迟写入、乐观锁、数据分表等高级特性的高级模型；可以轻松动态地创建数据库视图的视图模型；支持关联操作的关联模型；支持Mongo数据库的Mongo模型等等，都可以方便的使用。

**模块分组**：不用担心大项目的分工协调和部署问题，分组帮你解决跨项目的难题，还可以支持对分组的二级域名部署支持。

**模板引擎**：系统内建了一款卓越的基于XML的编译型模板引擎，支持两种类型的模板标签，融合了Smarty和JSP标签库的思想，并内置布局模板功能和标签库扩展支持。通过驱动还可以支持Smarty、EaseTemplate、TemplateLite、Smart等其他第三方模板引擎。

**AJAX支持**：内置和客户端无关的AJAX数据返回方法，支持JSON、XML和EVAL类型返回客户端，而且可以扩展返回数据格式，系统不绑定任何AJAX类库，可随意使用自己熟悉的AJAX类库进行操作。

**SAE支持**：提供了新浪SAE平台的强力支持，具备“横跨性”和“平滑性”，支持本地化开发和调试以及部署切换，让你轻松过渡到SAE开发，打造全新的SAE开发体验。

**RESTFul支持**：REST模式提供了RESTFul支持，为你打造全新的URL设计和访问体验，同时为接口应用提供了支持。

**多语言支持**：系统支持语言包功能，项目和分组都可以有单独的语言包，并且可以自动检测浏览器语言自动载入对应的语言包。

**模式扩展**：除了标准模式外，还提供了AMF、PHPRpc、Lite、Thin和Cli模式扩展支持，针对不同级别的应用开发提供最佳核心框架，还可以自定义模式扩展。

**自动验证和完成**：自动完成表单数据的验证和过滤，新版新增了IP验证和有效期验证等更多的验证方式，配合自动完成可以生成安全的数据对象。

**字段类型检测**：系统会自动缓存字段信息和字段类型，支持非法字段过滤和字段类型强制转换，确保数据写入和查询更安全。

**缓存机制**：系统支持包括文件方式、APC、Db、Memcache、Shmop、Sqlite、Redis、Eaccelerator和Xcache在内的动态数据缓存类型，以及可定制的静态缓存规则，并提供了快捷方法进行存取操作。

**扩展机制**：系统支持包括模式扩展、行为扩展、类库扩展、驱动扩展、模型扩展、控制器扩展、Widget扩展在内的强大灵活的扩展机制，让你不再受限于核心的不足和无所适从，随心DIY自己的框架和扩展应用，满足企业开发中更加复杂的项目需求。