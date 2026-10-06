<div class="rating-section">
    <h3>
        ⭐ MovieVerse Rating
    </h3>

    <?php if ($averageRating !== null): ?>

        <p class="average-rating">

            Community rating:
            <strong>
                <?= number_format((float) $averageRating, 1) ?>/10
            </strong>
        </p>

    <?php else: ?>

        <p class="average-rating">
            No ratings yet.
        </p>

    <?php endif; ?>


    <form
        action="/ratings/<?= (int) $movie['id'] ?>"
        method="POST"
        class="rating-form">
        <label for="rating">
            <?= $userRating !== null
                ? 'Change your rating:'
                : 'Rate this movie:' ?>
        </label>

        <select
            name="rating"
            id="rating"
            required>
            <option value="">
                Select rating
            </option>

            <?php for ($i = 1; $i <= 10; $i++): ?>

                <option
                    value="<?= $i ?>"
                    <?= $userRating == $i ? 'selected' : '' ?>>
                    <?= $i ?>/10
                </option>

            <?php endfor; ?>

        </select>

        <button
            type="submit"
            class="rating-button">
            <?= $userRating !== null
                ? 'Update Rating'
                : 'Rate Movie' ?>
        </button>
    </form>

</div>