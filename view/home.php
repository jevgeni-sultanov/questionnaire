        <main>
            <h1>Ask anything you want:</h1>
            <form action="<?= URL . $this->getLanguage() . '/home/' ?>" method="post">
                <input type="text" name="question" placeholder="Ask your question">
                <input type="submit" value="Send new question">
            </form>
        </main>
