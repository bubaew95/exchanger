import {ReactNode} from "react";

export interface MyModalProps {
    isOpen: boolean;
    closeModal: () => void;
    children: ReactNode;
    title?: string;
}