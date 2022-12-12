<div id="default-template">
    <div class="curriculum-header">
        <?php if (!empty($curriculum['avatar'])) : ?>
            <div class="curriculum-picture">
                <img src=<?= $curriculum['avatar'] ?> alt="<?= $curriculum['person_name'] ?>'s avatar" />
            </div>
        <?php endif; ?>

        <?php if (!empty($curriculum['person_name']) || !empty($curriculum['role'])) : ?>
            <div class="curriculum-header-info">
                <?php if (!empty($curriculum['person_name'])) : ?>
                    <h2>Hello, I am</h2>
                <?php endif; ?>
                <h1><?= $curriculum['person_name'] ?></h1>
                <h4><?= $curriculum['role'] ?></h4>
            </div>
        <?php endif; ?>
    </div>
    <div class="curriculum-body">
        <!-- LEFT COLUMN -->
        <div class="col">
            <?php if (count($curriculum['info']) > 0) : ?>
                <section class="info-section">
                    <h2><?= $curriculum['info_header'] ?></h2>

                    <?php foreach ($curriculum['info'] as $item) : ?>
                        <div>
                            <?php if (empty($item['href'])) : ?>
                                <i class="fa fa-2x fa-<?= $item['icon'] ?>"></i>
                                <?= $item['content'] ?>
                            <?php else : ?>
                                <a href="<?= $item['href'] ?>">
                                    <i class="fa fa-2x fa-<?= $item['icon'] ?>"></i>
                                    <?= $item['content'] ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>

            <?php if (count($curriculum['skills']) > 0) : ?>
                <section class="skills-section">
                    <h2><?= $curriculum['skills_header'] ?></h2>

                    <?php foreach ($curriculum['skills'] as $item) : ?>
                        <div>
                            <p><?= $item['content'] ?></p>
                            <ul>
                                <?php for ($x = 0; $x < $item['rating']; $x++) : ?>
                                    <li><i class="fa fa-circle"></i></li>
                                <?php endfor; ?>

                                <?php for ($x = 0; $x < 5 - $item['rating']; $x++) : ?>
                                    <li><i class="fa-regular fa-circle"></i></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>

            <?php if (count($curriculum['education']) > 0) : ?>
                <section class="education-section">
                    <h2><?= $curriculum['education_header'] ?></h2>

                    <?php foreach ($curriculum['education'] as $item) : ?>
                        <div class="education">
                            <p class="education-date">
                                <i class="fa fa-calendar"></i>
                                <?= $item['start_date'] ?> - <?= $item['end_date'] ?>
                            </p>
                            <h4><?= $item['school'] ?></h4>
                            <p><?= $item['course'] ?></p>
                            <p><small><?= $item['location'] ?></small></p>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col">
            <?php if (!empty($curriculum['summary'])) : ?>
                <section class="profile-section">
                    <h2><?= $curriculum['profile_header'] ?></h2>
                    <p>
                        <?= $curriculum['summary'] ?>
                    </p>
                </section>
            <?php endif; ?>

            <?php if (count($curriculum['experience']) > 0) : ?>
                <section class="experience-section">
                    <h2><?= $curriculum['experience_header'] ?></h2>

                    <?php foreach ($curriculum['experience'] as $item) : ?>
                        <div class="experience">
                            <div class="experience-title">
                                <h4><?= $item['company'] ?></h4>
                                <p class="experience-date">
                                    <i class="fa fa-calendar"></i>
                                    <?= $item['start_date'] ?> - <?= $item['end_date'] ?>
                                </p>
                            </div>
                            <p><?= $item['role'] ?></p>
                            <div><?= $item['summary'] ?></div>
                        </div>
                    <?php endforeach; ?>

                </section>
            <?php endif; ?>
        </div>
    </div>
</div>