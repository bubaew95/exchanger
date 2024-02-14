export interface RequestInterface {
    error: null | string;
    isLoading: boolean;
    data: RequestData[];
}

export interface RequestData {
    id: number;
    name: string;
    slug: string;
    description: string;
    image: string;
    isProposed?: boolean;
}
