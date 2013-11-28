<?php

class ReportController extends Controller {

    public function actionBooksHaving2Authors() {
        $data = Yii::app()->db->createCommand(
                        'select b.id, b.name, count(a.id) from {{book}} b ' .
                        'inner join {{book_author_xref}} ba_xref on ba_xref.book_id = b.id ' .
                        'inner join {{author}} a on a.id = ba_xref.author_id ' .
                        'group by b.id having count(a.id)>=3 ')->queryAll(true);
        $this->render('reportView', array(
            'reportName' => Reports::REPORT_booksHaving2Authors,
            'reportData' => $data,
            'linkControllerName' => 'book'
        ));
    }

    public function actionAuthorsReadBy3Readers() {
        $data = Yii::app()->db->createCommand(
                        'select a.id, a.name from {{author}} a ' .
                        'inner join {{book_author_xref}} ba_xref on ba_xref.author_id = a.id ' .
                        'inner join {{book}} b on ba_xref.book_id = b.id ' .
                        'inner join {{book_reader_xref}} br_xref on br_xref.book_id = b.id ' .
                        'inner join {{reader}} r on br_xref.reader_id = r.id ' .
                        'group by a.id having count(r.id)>=3 '
                )->queryAll(true);
        $this->render('reportView', array(
            'reportName' => Reports::REPORT_authorsReadBy3Readers,
            'reportData' => $data,
            'linkControllerName' => 'author'
        ));
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionRandomBooks() {
        $data = Yii::app()->db->createCommand(
                        'select id, name from {{book}} order by rand() limit 5')->queryAll(true);
        $this->render('reportView', array(
            'reportName' => Reports::REPORT_randomBooks,
            'reportData' => $data,
            'linkControllerName' => 'book'
        ));
    }

}