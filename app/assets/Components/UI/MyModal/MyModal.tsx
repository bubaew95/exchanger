import React from 'react';
import {MyModalProps} from "./MyModalInterface";
import {Button, Modal} from "react-bootstrap";

export const MyModal: React.FC<MyModalProps> = ({title = ' ', isOpen, closeModal, children }) => {
    return (
        <Modal
            show={isOpen}
            onHide={closeModal}
            backdrop="static"
            size="lg"
            scrollable={true}
            centered
        >
            <Modal.Header>
                {title && <Modal.Title>{title}</Modal.Title>}
                <Button variant="danger" className='btn-sm' onClick={closeModal}>
                    <i className="fa fa-times" aria-hidden="true"></i>
                </Button>
            </Modal.Header>
            <Modal.Body>
                {children}
            </Modal.Body>
        </Modal>
    );
};
